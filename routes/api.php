<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\InstituicaoController;

Route::get('/instituicoes', [InstituicaoController::class, 'index']);
