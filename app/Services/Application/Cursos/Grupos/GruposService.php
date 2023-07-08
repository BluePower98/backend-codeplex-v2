<?php

namespace App\Services\Application\Cursos\Grupos;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Proveedores\ProveedoresResource;
use App\Http\Resources\Proveedores\ProveedoresShowResource;
use App\Repositories\Inventory\InventoryRepositoryInterface;
use App\Repositories\Cursos\Cursos\CursosRepository;
use App\Repositories\Cursos\Grupos\GruposRepositoryInterface;

class GruposService
{
    private GruposRepositoryInterface $GruposRepository;

    public function __construct(
        GruposRepositoryInterface $GruposRepository
    )
    {
        $this->GruposRepository = $GruposRepository;
    }

    public function datatables(Request $request): Collection
    {
        return $this->GruposRepository->datatables($request);
    }

    public function store(Request $request): Collection
    {
        return $this->GruposRepository->store($request->all());
    }

    public function update(Request $request, string $idempresa, int $idgrupo): Collection
    {
        return $this->GruposRepository->update($request->all(), $idempresa, $idgrupo);
    }

    public function delete(string $idempresa, int $idgrupo): Collection
    {
        return $this->GruposRepository->delete($idempresa, $idgrupo);
    }

    public function show(string $idempresa, int $idgrupo): Collection
    {
        return $this->GruposRepository->show($idempresa, $idgrupo);
    }

    public function getCursos(string $idempresa): Collection
    {
        return $this->GruposRepository->getCursos($idempresa);
    }

    public function getMondedas(): Collection
    {
        return $this->GruposRepository->getMondedas();
    }
}
