<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

abstract class BaseRepository {
    protected function lerJson(string $filename): Collection {
        $path = storage_path("app/data/{$filename}");
        return collect(json_decode(file_get_contents($path), true));
    }

    protected function listarChaveValor(string $filename, string $key = 'id', string $value = 'nome'): array {
        return $this->lerJson($filename)->pluck($value, $key)->toArray();
    }

}
