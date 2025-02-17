<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProgrammesController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/programmes', [ProgrammesController::class, 'getIndex']);


Route::get('/programmes/{id}', [ProgrammesController::class, 'show']);


Route::post('/programmes', [ProgrammesController::class, 'store']);

Route::put('/programmes/{id}', [ProgrammesController::class,'update']);

Route::delete('/programmes/{id}', [ProgrammesController::class, 'destroy']);

Route::post('/check',[ProgrammesController::class,'check']);

