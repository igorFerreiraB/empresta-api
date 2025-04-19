<?php

namespace App\Repositories;

class JsonRepository extends BaseRepository {
    public function obterInstituicoes(): array {
        return $this->listarChaveValor('instituicoes.json');
    }

    public function obterConvenios(): array {
        return $this->listarChaveValor('convenios.json');
    }

    public function obterTaxas(): array {
        return $this->lerJson('taxas.json')->all();
    }
}
