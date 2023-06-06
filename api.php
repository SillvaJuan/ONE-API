<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\DadosController;

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

Route::post('/cadastro',[DadosController::class, 'Create']);
Route::get('dados', [DadosController::class, 'getAllClientes']);
Route::put('/editar/{id}',[DadosController::class, 'edit']);
Route::delete('/excluir/{id}', [DadosController::class, 'delete']);
