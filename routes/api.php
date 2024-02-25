<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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



Route::middleware('auth:sanctum')->group( function(){
    Route::get('/home', [AuthController::class,'index']);
    Route::get('/logout',[AuthController::class,'logout']);
}
);

Route::controller(AuthController::class)->group( function() {
    Route::post('/register','store');
    Route::post('/login', 'login');
    Route::post('/logout', 'destroy');
    Route::post('/resetPassword', 'update');
});

Route::get('/pruebaInicial', function(){ return response()->json('hola aqui prueba inicial');});