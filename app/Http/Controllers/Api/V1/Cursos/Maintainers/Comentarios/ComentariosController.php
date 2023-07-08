<?php

namespace App\Http\Controllers\Api\V1\Cursos\Maintainers\Comentarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cursos;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Application\Cursos\Comentarios\ComentariosService;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Proveedores\ProveedoresStoreRequest;
// use App\Services\Application\Proveedores\ProveedoresSaveService;

class ComentariosController extends ApiController
{
    private ComentariosService $ComentariosService;

    public function __construct(
        ComentariosService $ComentariosService,
    ) 

    {
        $this->ComentariosService = $ComentariosService;
    }

    public function datatables(Request $request): JsonResponse
    {
        $result = $this->ComentariosService->datatables($request);

        return $this->datatablesResponse($result);

    }

    public function store(Request $request): JsonResponse
    {
        $this->ComentariosService->store($request);

        return $this->showMessage("Comentario registrado Correctamente", Response::HTTP_CREATED);
    }

    public function update(Request $request, string $idempresa, int $idcomentarios): JsonResponse
    {

        $result = $this->ComentariosService->update($request, $idempresa, $idcomentarios);

        return $this->successResponse($result, "Comentario actualizado Correctamente");
    }

    public function delete(string $idempresa, int $idcomentarios): JsonResponse
    {
        $result = $this->ComentariosService->delete($idempresa, $idcomentarios);

        return $this->successResponse($result,"El Comentario seleccionado se ha eliminado correctamente.");
    }

    public function show(string $idempresa, int $idcomentarios): JsonResponse
    {
        $result = $this->ComentariosService->show($idempresa, $idcomentarios);

        return $this->successResponse($result,"El Comentario seleccionado a traido los datos correctamente");
    }
}
