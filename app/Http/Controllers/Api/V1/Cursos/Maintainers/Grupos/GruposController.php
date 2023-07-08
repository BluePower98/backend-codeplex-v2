<?php

namespace App\Http\Controllers\Api\V1\Cursos\Maintainers\Grupos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\Grupos;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Application\Cursos\Grupos\GruposService;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Proveedores\ProveedoresStoreRequest;
// use App\Services\Application\Proveedores\ProveedoresSaveService;

class GruposController extends ApiController
{
    private GruposService $GruposService;

    public function __construct(
        GruposService $GruposService,
        // ProveedoresSaveService $ProveedoresSaveService,
    )
    {
        $this->GruposService = $GruposService;
    }

    public function datatables(Request $request): JsonResponse
    {
        $result = $this->GruposService->datatables($request);

        return $this->datatablesResponse($result);

    }

    public function store(Request $request): JsonResponse
    {
        $this->GruposService->store($request);

        return $this->showMessage("Grupo registrado Correctamente", Response::HTTP_CREATED);
    }

    public function update(Request $request, string $idempresa, int $idgrupo): JsonResponse
    {

        $result = $this->GruposService->update($request, $idempresa, $idgrupo);

        return $this->successResponse($result, "Grupo actualizado Correctamente");
    }

    public function delete(string $idempresa, int $idgrupo): JsonResponse
    {
        $result = $this->GruposService->delete($idempresa, $idgrupo);

        return $this->successResponse($result,"El Grupo seleccionado se ha eliminado correctamente.");
    }

    public function show(string $idempresa, int $idgrupo): JsonResponse
    {
        $result = $this->GruposService->show($idempresa, $idgrupo);

        return $this->successResponse($result,"El Grupo seleccionado a traido los datos correctamente");
    }

    public function getCursos(string $idempresa): JsonResponse
    {
        $result = $this->GruposService->getCursos($idempresa);

        return $this->successResponse($result,"El Grupo seleccionado a traido los datos de Cursos");
    }

    public function getMondedas(): JsonResponse
    {
        $result = $this->GruposService->getMondedas();

        return $this->successResponse($result,"El Grupo seleccionado a traido los datos de Monedas");
    }


}
