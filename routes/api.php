<?php

use App\Custom\Login\CommonAuth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\UserController;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\CommonUI\Clear\DepartmentResource;
use App\Http\Resources\CommonUI\Clear\UserResource;
use App\Models\Department;
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

Route::post('/login', fn(AuthRequest $request) => CommonAuth::init($request) );

Route::controller(UserController::class)->middleware(['auth:sanctum'])->group(function () {
    Route::get('/my', 'info');
    Route::get('/my/services', 'services');
    Route::patch('/my/edit', 'edit');
    Route::patch('/my/edit/password', 'change_password');
    Route::delete('/my/services/logout/{id}', 'service_logout')->whereNumber('id');
});

Route::controller(AdminController::class)->prefix('/admin')->group(function () {
    Route::middleware(['auth:sanctum', 'ability:add'])->group(function () {

    });
    Route::middleware(['auth:sanctum', 'ability:create'])->group(function () {
        Route::post('/users/add', 'new_user');
        Route::post('/users/set/property', 'set_property');
    });
    Route::middleware(['auth:sanctum', 'ability:edit'])->group(function () {
//        Route::patch();
    });
    Route::middleware(['auth:sanctum', 'ability:delete'])->group(function () {
//        Route::delete();
    });
});

Route::controller(DepartmentController::class)->middleware(['auth:sanctum'])->group(function () {
    Route::get('/departments/all', fn() => response()->json( DepartmentResource::collection( Department::all() )));
    Route::get('/departments/{department}', fn(Department $department) => response()->json($department));
    Route::get('/departments/{department}/users', fn(Department $department) => response()->json( UserResource::collection($department->users) ));

    Route::middleware(['auth:sanctum', 'ability:add'])->prefix('/admin')->group(function () {
        Route::post('/departments/add', 'create');
    });
});

Route::controller(PositionController::class)->middleware(['auth:sanctum'])->group(function () {
    Route::middleware(['auth:sanctum', 'ability:create'])->prefix('/admin')->group(function () {
        Route::match(['post', 'patch'],'/positions', 'interact');
    });
});




//        Route::post('/users/{user}/add/access', 'new_access')->whereNumber('user');
//        Route::post('/users/{user}/add/department')->whereNumber('user');
//        Route::post('/users/{user}/add/position')->whereNumber('user');
//        Route::post('/users/{user}/add/');
