<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgreementRequest;
use App\Http\Resources\CommonUI\Clean\UserResource;
use App\Http\Resources\CommonUI\User\ServiceResource;
use App\Models\Service;
use App\Models\UserService;
use App\Source\Service\Intentions\Service as PostmanService;
use App\Source\Assertion\UserAssertion;
use App\Source\Login\Access\AccessProvider;
use App\Source\Login\Access\PasswordProvider;
use App\Source\Service\Resources\PasswordServiceResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Str;

class AccessProviderController extends Controller
{
    public function service (Request $request): JsonResponse
    {
        $requestService = Str::ucfirst( $request->get('service') ); /* Get service name to give access and capitalize first letter */
        $service = Service::query()->where('name', $requestService)->get()->first(); /* Get service model */

        $isUserAccessed = $request->user()->services->contains(function ($value) use ($requestService) {
            if ($value->name == $requestService and $value->service_for->blocked)
                static::serviceForThisUserBlocked($value);

            return $value->name == $requestService;
        });

        if ($isUserAccessed)
        {
            $token = (new AccessProvider($request->user(), $service))->externalToken;

            return response()->json([
                'externalToken' => $token,
                'service' => new ServiceResource($service)
            ]);
        }

        $crossCode = (new UserAssertion($request->user()))->generate();

        return response()->json([
            'component' => 'Agreement',
            'redirect' => URL::to("/access/agreement?service=$requestService&code=$crossCode"),
            'info' => new UserResource($request->user()),
            'service' => new ServiceResource($service),
            'code' => $crossCode
        ]);
    }

    public function add (AgreementRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = $request->user();

        $requestService = Str::ucfirst( $request->get('service') );
        $service = Service::query()->where('name', $requestService)->get(); /** @var Service $service */
        $validCode = (new UserAssertion($user))->isValid($request->get('code'));

        if (!$validCode)
            return response()->json(['message' => 'Invalid cross action code'], 403);

        if (!PasswordProvider::attempt($data['password'], $user->password))
            return response()->json(['message' => 'Can\'t give an access. Invalid password']);

        $produceToService = PostmanService::produce($service, $user);
        UserService::create([
            'user_id' => $user->id,
            'service_id' => $service->first()->id
        ]);
        PostmanService::notify(PasswordServiceResource::class, $user, false);
        return response()->json($produceToService);
    }

    /*
     * If user is blocked on this system show a specific messages
     */
    public static function serviceForThisUserBlocked (Service $service)
    {
        response()->json([
            'message' => 'You blocked on this service',
            'service' => new ServiceResource($service)
        ])->throwResponse();
    }


}
