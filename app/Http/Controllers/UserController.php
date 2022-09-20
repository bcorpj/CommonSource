<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\CommonUI\User\ServiceResource;
use App\Http\Resources\CommonUI\User\UserResource;
use App\Models\Service;
use App\Source\Login\Access\TokenProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function info (Request $request): JsonResponse
    {
        return response()->json(new UserResource($request->user()));
    }

    public function edit (UserRequest $request): JsonResponse
    {
        $request->user()->update($request->validated());
        // notify to services
        return response()->json(['message' => 'Successfully updated']);
    }

    public function change_password (PasswordRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = $request->user();

        if ( !TokenProvider::attempt( $data['old_password'], $user->password ))
            return response()->json(['message' => 'Old password does not match']);

        $user->update([ 'password' => TokenProvider::hash( $data['new_password'] ) ]);
        // notify to services,
        // Service::notify(UserDataService::class, $user)
        // Service::notify(PasswordChangeService::class, $user)
        // Service::notify(DepartmentAddService::class, $department)

        return response()->json(['message' => 'Password successfully updated']);
    }

    public function services (Request $request): JsonResponse
    {
        return response()->json(ServiceResource::collection( $request->user()->services ));
    }

    public function service_logout (Request $request, Service $service): JsonResponse
    {
        // remove auth token in service
        return response()->json(['message' => 'Successfully logout from service']);
    }
}
