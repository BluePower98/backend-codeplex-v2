<?php

namespace App\Repositories\Proveedores;

use App\Models\Proveedor;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface ProveedoresRepositoryInterface extends BaseRepositoryInterface
{
    public function datatables(Request $request): Collection;

    public function store(array $params): Collection;

    public function update(array $params, string $idempresa, int $rucdni): Collection;

    public function delete(string $idempresa, string $rucdni): Collection;

    public function show(string $idempresa, string $rucdni): Collection;

    public function searchUbigeo(string $idubigeo): collection;

}

