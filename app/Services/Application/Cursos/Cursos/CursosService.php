<?php

namespace App\Services\Application\Cursos\Cursos;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Proveedores\ProveedoresResource;
use App\Http\Resources\Proveedores\ProveedoresShowResource;
use App\Repositories\Inventory\InventoryRepositoryInterface;
use App\Repositories\Cursos\Cursos\CursosRepository;
use App\Repositories\Cursos\Cursos\CursosRepositoryInterface;

class CursosService
{
    private CursosRepositoryInterface $CursosRepository;

    public function __construct(
        CursosRepositoryInterface $CursosRepository
    )
    {
        $this->CursosRepository = $CursosRepository;
    }

    public function datatables(Request $request): Collection
    {
        return $this->CursosRepository->datatables($request);
    }

    public function store(Request $request): Collection
    {
        return $this->CursosRepository->store($request->all());
    }

    public function update(Request $request, string $idempresa, int $idcurso): Collection
    {
        return $this->CursosRepository->update($request->all(), $idempresa, $idcurso);
    }

    public function delete(string $idempresa, int $idcurso): Collection
    {
        return $this->CursosRepository->delete($idempresa, $idcurso);
    }  

    public function show(string $idempresa, int $idcurso): Collection
    {
        return $this->CursosRepository->show($idempresa, $idcurso);
    } 
    
    public function getEspecialidades(string $idempresa): Collection
    {
        return $this->CursosRepository->getEspecialidades($idempresa);
    }
}