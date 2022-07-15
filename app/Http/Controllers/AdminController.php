<?php

namespace App\Http\Controllers;

use App\Custom\Login\Anil\PasswordProvider;
use App\Http\Requests\UserPropertyRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\CommonUI\User\UserPropertyResource;
use App\Models\User;
use App\Models\UserProperty;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{
    public function new_user(UserRequest $request): JsonResponse
    {
        $data = PasswordProvider::add( $request->validated() );

        return response()->json([
            'message' => 'Created Successfully',
            'id' => User::create( $data )->id
        ]);
    }

    public function set_property(UserPropertyRequest $request): JsonResponse
    {
        $data = $request->validated();

        $property = UserProperty::updateOrCreate(
            ['user_id' => $data['user_id']],
            ['position_id' => $data['position_id'], 'department_id' => $data['department_id'] ]
        );

        return response()->json( new UserPropertyResource ( UserProperty::find( $property->id ) ) );
    }



}
