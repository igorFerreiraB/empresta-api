<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\JsonRepository;

class InstituicaoController extends Controller {
    public function index(JsonRepository $repository) {
        $instituicoes = $repository->obterInstituicoes();
        return response()->json($instituicoes);
    }
}
