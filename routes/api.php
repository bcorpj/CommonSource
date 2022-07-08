<?php

use App\Custom\Login\CommonAuth;
use App\Http\Controllers\UserController;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\CommonUI\UserResource;
use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Http\Request;
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

Route::get('/res', function () {
    return response()->json(
        new UserResource(User::find(7))
    );
});

Route::controller(UserController::class)->group(function () {
    Route::get('/temp', function (Request $request) {

    })->middleware(['auth:sanctum', 'ability:role-admin']);
});
