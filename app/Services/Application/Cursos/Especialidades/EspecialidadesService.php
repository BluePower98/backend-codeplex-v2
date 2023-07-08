<?php

namespace App\Services\Application\Cursos\Especialidades;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Proveedores\ProveedoresResource;
use App\Http\Resources\Proveedores\ProveedoresShowResource;
use App\Repositories\Inventory\InventoryRepositoryInterface;
use App\Repositories\Cursos\Especialidades\EspecialidadesRepository;
use App\Repositories\Cursos\Especialidades\EspecialidadesRepositoryInterface;

class EspecialidadesService
{
    private EspecialidadesRepositoryInterface $EspecialidadesRepository;

    public function __construct(
        EspecialidadesRepositoryInterface $EspecialidadesRepository
    )
    {
        $this->EspecialidadesRepository = $EspecialidadesRepository;
    }

    public function datatables(Request $request): Collection
    {
        return $this->EspecialidadesRepository->datatables($request);
    }

    public function store(Request $request): Collection
    {
        return $this->EspecialidadesRepository->store($request->all());
    }

    public function update(Request $request, string $idempresa, int $idespecialidad): Collection
    {
        return $this->EspecialidadesRepository->update($request->all(), $idempresa, $idespecialidad);
    }

    public function delete(string $idempresa, int $idespecialidad): Collection
    {
        return $this->EspecialidadesRepository->delete($idempresa, $idespecialidad);
    }  

    public function show(string $idempresa, int $idespecialidad): Collection
    {
        return $this->EspecialidadesRepository->show($idempresa, $idespecialidad);
    }  
}