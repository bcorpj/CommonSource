<?php

use App\Custom\Login\CommonAuth;
use App\Http\Controllers\UserController;
use App\Http\Requests\AuthRequest;
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



//Route::get('/res', function () {
//    return response()->json(
//        new UserResource(User::find(7))
//    );
//});
