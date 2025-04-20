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

            $coeficiente = $this->calcularCoeficiente($taxa['taxa'] / 100, $taxa['parcelas']);
            $valorParcela = $valorEmprestimo * $coeficiente;
            $valorTotal = $valorParcela * $taxa['parcelas'];

            $resultados[] = [
                'instituicao' => $taxa['instituicao'],
                'convenio' => $taxa['convenio'],
                'parcelas' => $taxa['parcelas'],
                'taxa' => $taxa['taxa'],
                'valor_parcela' => round($valorParcela, 2),
                'valor_total' => round($valorTotal, 2),
                'coeficiente' => round($coeficiente, 6)
            ];
        }

        return $resultados;
    }

    public function calcularCoeficiente(float $taxaMensal, int $parcelas): float
    {
        $i = $taxaMensal;
        $n = $parcelas;

        $potencia = pow(1 + $i, $n);

        return ($i * $potencia) / ($potencia - 1);
    }

}
