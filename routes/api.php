<?php

use App\Custom\Login\CommonAuth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\UserController;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\CommonUI\Clean\DepartmentResource;
use App\Http\Resources\CommonUI\Clean\UserResource;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/*
 *
 * Response without return
 *
 * response()->json($messages_array, $status_code)->throwResponse();
 *
 */

Route::post('/login', fn(AuthRequest $request) => CommonAuth::init($request) );

Route::controller(UserController::class)->middleware(['auth:sanctum'])->group(function () {
    Route::get('/my', 'info');
    Route::get('/my/services', 'services');
    Route::patch('/my/edit', 'edit');
    Route::patch('/my/edit/password', 'change_password');
    Route::delete('/my/services/logout/{service}', 'service_logout');
});

Route::controller(AdminController::class)->middleware(['auth:sanctum', 'ability:add,edit,create,delete'])->prefix('/admin')->group(function () {
    Route::get('/users/all', fn () => response()->json(UserResource::collection(User::all())));

    Route::middleware(['auth:sanctum', 'abilities:add,edit'])->group(function () {
        Route::match(['post', 'patch'],'/add', 'interact_admin');
    });
    Route::middleware(['auth:sanctum', 'ability:create'])->group(function () {
        Route::post('/users/create', 'new_user');
        Route::post('/users/set/property', 'set_property');
    });
    Route::middleware(['auth:sanctum', 'ability:edit'])->group(function () {
        Route::patch('/users/{user}', 'edit_user');
    });
    Route::middleware(['auth:sanctum', 'ability:delete'])->group(function () {
        Route::delete('/delete/{user}', 'delete' )->whereNumber('user');
    });
});

Route::controller(DepartmentController::class)->middleware(['auth:sanctum'])->group(function () {
    Route::get('/departments/all', fn() => response()->json( DepartmentResource::collection( Department::all() )));
    Route::get('/departments/{department}', fn(Department $department) => response()->json($department));
    Route::get('/departments/{department}/users', fn(Department $department) => response()->json( UserResource::collection($department->users) ));

    Route::middleware(['auth:sanctum', 'abilities:add,create,edit,delete'])->prefix('/admin')->group(function () {
        Route::post('/departments/add', 'create');
    });
});

Route::controller(PositionController::class)->middleware(['auth:sanctum'])->group(function () {
    Route::get('/positions', fn() => response()->json( Position::all() ));
    Route::middleware(['auth:sanctum', 'ability:create'])->prefix('/admin')->group(function () {
        Route::match(['post', 'patch'],'/positions', 'interact');
    });
});


