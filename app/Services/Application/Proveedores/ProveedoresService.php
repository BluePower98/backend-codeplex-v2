<?php

namespace App\Services\Application\Proveedores;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Proveedores\ProveedoresResource;
use App\Http\Resources\Proveedores\ProveedoresShowResource;
use App\Repositories\Inventory\InventoryRepositoryInterface;
use App\Repositories\Proveedores\ProveedoresRepository;
use App\Repositories\Proveedores\ProveedoresRepositoryInterface;

class ProveedoresService
{
    private ProveedoresRepositoryInterface $ProveedoresRepository;

    public function __construct(
        ProveedoresRepositoryInterface $ProveedoresRepository
    )
    {
        $this->ProveedoresRepository = $ProveedoresRepository;
    }

    public function datatables(Request $request): Collection
    {
        return $this->ProveedoresRepository->datatables($request);
    }

    public function store(Request $request): Collection
    {
        return $this->ProveedoresRepository->store($request->all());
    }

    public function update(Request $request, string $idempresa, int $rucdni): Collection
    {
        return $this->ProveedoresRepository->update($request->all(), $idempresa, $rucdni);
    }

    public function delete(string $idempresa, string $rucdni): Collection
    {
        return $this->ProveedoresRepository->delete($idempresa, $rucdni);
    }   

    public function show(string $idempresa, string $rucdni): Collection
    {
        return $this->ProveedoresRepository->show($idempresa, $rucdni);
    }   

    public function searchUbigeo(string $idubigeo): Collection
    {
            $result=$this->ProveedoresRepository->searchUbigeo($idubigeo);
            return  collect($result);
    }

}

