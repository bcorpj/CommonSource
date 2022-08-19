<?php

namespace App\Http\Controllers;

use App\Custom\Login\Intention\PasswordProvider;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\UserPropertyRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\CommonUI\Clean\AdminResource;
use App\Http\Resources\CommonUI\User\UserPropertyResource;
use App\Models\Admin;
use App\Models\User;
use App\Models\UserProperty;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{

    public function interact_admin (AdminRequest $request): JsonResponse
    {
        $data = $request->validated();
        $admin = Admin::updateOrCreate(['user_id' => $data['user_id']], $data);
        return response()->json( new AdminResource( $admin ) );
    }

    public function new_user (UserRequest $request): JsonResponse
    {
        $data = PasswordProvider::add( $request->validated() );
        return response()->json([
            'message' => 'Created Successfully',
            'id' => User::create( $data )->id
        ]);
    }

    public function set_property (UserPropertyRequest $request): JsonResponse
    {
        $data = $request->validated();
        $property = UserProperty::updateOrCreate(['user_id' => $data['user_id']], $data);
        return response()->json( new UserPropertyResource ( UserProperty::find( $property->id ) ) );
    }

    public function edit_user (User $user, UserRequest $request): JsonResponse
    {
        $user->update($request->validated());
        return response()->json($user);
    }

    public function delete (User $user): JsonResponse
    {
        $user->admin()->delete();
        return response()->json(['message' => "Admin {$user->login} has been deleted"]);
    }

}
