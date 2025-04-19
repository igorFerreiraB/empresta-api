<?php

namespace App\Services;

use App\Repositories\JsonRepository;

class SimulacaoService
{
    public function __construct(protected JsonRepository $repository) {}

    public function calcular(
        float $valorEmprestimo,
        ?int $parcelasDesejadas,
        array $instituicoesFiltro,
        array $conveniosFiltro): array {

        $taxas = $this->repository->obterTaxas();
        $resultados = [];

        foreach ($taxas as $taxa) {
            if (!empty($instituicoesFiltro) && !in_array($taxa['instituicao'], $instituicoesFiltro)) {
                continue;
            }

            if (!empty($conveniosFiltro) && !in_array($taxa['convenio'], $conveniosFiltro)) {
                continue;
            }

            if ($parcelasDesejadas !== null && $taxa['parcelas'] != $parcelasDesejadas) {
                continue;
            }

            $valorParcela = $valorEmprestimo * $taxa['coeficiente'];
            $valorTotal = $valorParcela * $taxa['parcelas'];

            $resultados[] = [
                'instituicao' => $taxa['instituicao'],
                'convenio' => $taxa['convenio'],
                'parcelas' => $taxa['parcelas'],
                'taxa' => $taxa['taxa'],
                'valor_parcela' => round($valorParcela, 2),
                'valor_total' => round($valorTotal, 2)
            ];
        }

        return $resultados;
    }
}
