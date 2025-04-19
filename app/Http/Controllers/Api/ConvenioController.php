<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\JsonRepository;

class ConvenioController extends Controller {
    public function index(JsonRepository $repository) {
        $convenios = $repository->obterConvenios();
        return response()->json($convenios);
    }
}
