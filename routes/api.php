<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\InstituicaoController;
use App\Http\Controllers\Api\ConvenioController;

Route::get('/instituicoes', [InstituicaoController::class, 'index']);
Route::get('/convenios', [ConvenioController::class, 'index']);
