<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SimulacaoService;
use Illuminate\Http\JsonResponse;

class SimulacaoController extends Controller {
    public function simular(Request $request, SimulacaoService $service): JsonResponse {
        $data = $request->validate([
            'valor_emprestimo' => 'required|numeric|min:100',
            'parcelas' => 'sometimes|integer|min:1',
            'instituicoes' => 'sometimes|array',
            'instituicoes.*' => 'string',
            'convenios' => 'sometimes|array',
            'convenios.*' => 'string'
        ]);

        $resultado = $service->calcular(
            (float) $data['valor_emprestimo'],
            $data['parcelas'] ?? null,
            $data['instituicoes'] ?? [],
            $data['convenios'] ?? []
        );

        return response()->json($resultado);
    }
}
