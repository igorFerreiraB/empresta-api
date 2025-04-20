<?php

use App\Services\SimulacaoService;
use App\Repositories\JsonRepository;

it('calcula corretamente as simulações com taxa e parcelas', function () {
    $mockedTaxas = [
        [
            'instituicao' => 'Banco Exemplo',
            'convenio' => 'INSS',
            'parcelas' => 12,
            'taxa' => 2.0, // 2% ao mês
        ],
    ];

    // Esperado: coeficiente calculado com 2% ao mês por 12 parcelas
    $expectedCoeficiente = (new SimulacaoService(mock(JsonRepository::class)))->calcularCoeficiente(0.02, 12);
    $expectedParcela = round(1000 * $expectedCoeficiente, 2);
    $expectedTotal = round($expectedParcela * 12, 2);

    $repository = mock(JsonRepository::class);
    $repository->shouldReceive('obterTaxas')
        ->once()
        ->andReturn($mockedTaxas);

    $service = new SimulacaoService($repository);

    $result = $service->calcular(
        valorEmprestimo: 1000,
        parcelasDesejadas: 12,
        instituicoesFiltro: ['Banco Exemplo'],
        conveniosFiltro: ['INSS']
    );

    expect($result)->toHaveCount(1);

    expect($result[0])->toMatchArray([
        'instituicao' => 'Banco Exemplo',
        'convenio' => 'INSS',
        'parcelas' => 12,
        'taxa' => 2.0,
        'valor_parcela' => $expectedParcela,
        'valor_total' => $expectedTotal,
        'coeficiente' => round($expectedCoeficiente, 6),
    ]);
});
