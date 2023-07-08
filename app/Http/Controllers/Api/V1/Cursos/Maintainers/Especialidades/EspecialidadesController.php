<?php

namespace App\Http\Controllers\Api\V1\Cursos\Maintainers\Especialidades;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\Cursos;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Application\Cursos\Especialidades\EspecialidadesService;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Proveedores\ProveedoresStoreRequest;
// use App\Services\Application\Proveedores\ProveedoresSaveService;

class EspecialidadesController extends ApiController
{
    private EspecialidadesService $EspecialidadesService;

    public function __construct(
        EspecialidadesService $EspecialidadesService,
        // ProveedoresSaveService $ProveedoresSaveService,
    ) 
    {
        $this->EspecialidadesService = $EspecialidadesService;
    }

    public function datatables(Request $request): JsonResponse
    {
        $result = $this->EspecialidadesService->datatables($request);

        return $this->datatablesResponse($result);

    }

    public function store(Request $request): JsonResponse
    {
        $this->EspecialidadesService->store($request);

        return $this->showMessage("Especialidad registrado Correctamente", Response::HTTP_CREATED);
    }

    public function update(Request $request, string $idempresa, int $idespecialidad): JsonResponse
    {

        $result = $this->EspecialidadesService->update($request, $idempresa, $idespecialidad);

        return $this->successResponse($result, "Especialidad actualizado Correctamente");
    }

    public function delete(string $idempresa, int $idespecialidad): JsonResponse
    {
        $result = $this->EspecialidadesService->delete($idempresa, $idespecialidad);

        return $this->successResponse($result,"La Especialidad seleccionada se ha eliminado correctamente.");
    }

    public function show(string $idempresa, int $idespecialidad): JsonResponse
    {
        $result = $this->EspecialidadesService->show($idempresa, $idespecialidad);

        return $this->successResponse($result,"La Especialidad seleccionado a traido los datos correctamente");
    }
}
