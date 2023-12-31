<?php

namespace App\Repositories\Cursos\Instructores;

use App\Models\Instructores;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface InstructoresRepositoryInterface extends BaseRepositoryInterface
{
    public function datatables(Request $request): Collection;

    public function store(array $params): Collection;

    public function update(array $params, string $idempresa, int $idinstructor): Collection;

    public function delete(string $idempresa, int $idinstructor): Collection;

    public function show(string $idempresa, int $idinstructor): Collection;
}