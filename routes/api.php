<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController,PermissionsController,RolesController,UserController};

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
    Route::post('register', [AuthController::class, 'register']);



         Route::get('users/permissions', [UserController::class, 'getUserPermission']);
        // User Roles
        Route::post('users/{user}/roles/assign', [UserController::class, 'assignRoleToUser']);
        Route::post('users/{user}/roles/revoke', [UserController::class, 'revokeRoleFromUser']);

        // Role Permissions
        Route::post('roles/{role}/permissions/assign', [RolesController::class, 'assignPermissionToRole']);
        Route::post('roles/{role}/permissions/revoke', [RolesController::class, 'revokePermissionFromRole']);



    Route::resources([
        'roles' => RolesController::class,
        'users' => UserController::class,
        'permissions' => PermissionsController::class,
    ]);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
