<?php

use App\Custom\FakeFill\DepartmentCreator;
use App\Custom\FakeFill\PositionCreator;
use App\Custom\FakeFill\UserCreator;
use App\Custom\FakeFill\UserPropertiesCreator;
use App\Custom\Login\CommonAuth;
use App\Http\Controllers\UserController;
use App\Http\Requests\AuthRequest;
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

Route::controller(UserController::class)->group(function () {
    Route::get('/temp', function (Request $request) {
        new UserPropertiesCreator();
    })->middleware(['auth:sanctum', 'ability:role-admins']);
});
