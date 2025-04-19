<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\InstituicaoController;
use App\Http\Controllers\Api\ConvenioController;
use App\Http\Controllers\Api\SimulacaoController;

Route::get('/instituicoes', [InstituicaoController::class, 'index']);
Route::get('/convenios', [ConvenioController::class, 'index']);
Route::post('/simulacao', [SimulacaoController::class, 'simular']);
