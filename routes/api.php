<?php


use App\Http\Controllers\Api\UserController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Asignar un nombre a la ruta de recurso 'users'
Route::apiResource('/users', UserController::class)->names([
    'index' => 'api.users.index',
    // 'store' => 'api.users.store',
    // 'show' => 'api.users.show',
    // 'update' => 'api.users.update',
    // 'destroy' => 'api.users.destroy',
]);
