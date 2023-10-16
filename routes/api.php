<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ItemController;
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

Route::get('items',[ItemController::class,'index']);
Route::get('items/{id}',[ItemController::class,'show']);
Route::post('items',[ItemController::class,'store']);
Route::put('items/{id}',[ItemController::class,'update']);
Route::delete('items/{id}',[ItemController::class,'delete']);
Route::put('items/{id}/restore',[ItemController::class,'restore']);

