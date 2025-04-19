<?php

namespace App\Repositories;

class JsonRepository extends BaseRepository {
    public function obterInstituicoes(): array {
        return $this->listarChaveValor('instituicoes.json');
    }
}
