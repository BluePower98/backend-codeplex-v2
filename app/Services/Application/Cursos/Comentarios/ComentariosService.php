<?php

namespace App\Services\Application\Cursos\Comentarios;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Proveedores\ProveedoresResource;
use App\Http\Resources\Proveedores\ProveedoresShowResource;
use App\Repositories\Inventory\InventoryRepositoryInterface;
use App\Repositories\Cursos\Cursos\CursosRepository;
use App\Repositories\Cursos\Comentarios\ComentariosRepositoryInterface;

class ComentariosService
{
    private ComentariosRepositoryInterface $ComentariosRepository;

    public function __construct(
        ComentariosRepositoryInterface $ComentariosRepository
    )
    {
        $this->ComentariosRepository = $ComentariosRepository;
    }

    public function datatables(Request $request): Collection
    {
        return $this->ComentariosRepository->datatables($request);
    }

    public function store(Request $request): Collection
    {
        return $this->ComentariosRepository->store($request->all());
    }

    public function update(Request $request, string $idempresa, int $idcomentarios): Collection
    {
        return $this->ComentariosRepository->update($request->all(), $idempresa, $idcomentarios);
    }

    public function delete(string $idempresa, int $idcomentarios): Collection
    {
        return $this->ComentariosRepository->delete($idempresa, $idcomentarios);
    }  

    public function show(string $idempresa, int $idcomentarios): Collection
    {
        return $this->ComentariosRepository->show($idempresa, $idcomentarios);
    }   
}