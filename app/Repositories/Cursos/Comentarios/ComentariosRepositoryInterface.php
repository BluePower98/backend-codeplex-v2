<?php

namespace App\Repositories\Cursos\Comentarios;

use App\Models\Cursos;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface ComentariosRepositoryInterface extends BaseRepositoryInterface
{
    public function datatables(Request $request): Collection;

    public function store(array $params): Collection;

    public function update(array $params, string $idempresa, int $idcomentarios): Collection;

    public function delete(string $idempresa, int $idcomentarios): Collection;

    public function show(string $idempresa, int $idcurso): Collection;
}