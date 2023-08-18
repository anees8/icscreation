<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController,PermissionsController,RolesController};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/users', [AuthController::class, 'me']);
    Route::post('register', [AuthController::class, 'register']);

    Route::resources([
        'roles' => RolesController::class,
        'permissions' => PermissionsController::class,
    ]);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
