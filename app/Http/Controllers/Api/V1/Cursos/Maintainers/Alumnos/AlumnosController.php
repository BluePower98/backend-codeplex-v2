<?php

namespace App\Http\Controllers\Api\V1\Cursos\Maintainers\Alumnos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\Proveedor;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Application\Cursos\Alumnos\AlumnosService;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Proveedores\ProveedoresStoreRequest;

class AlumnosController extends ApiController
{
    private AlumnosService $AlumnosService;

    public function __construct(

        AlumnosService $AlumnosService,

    )
    {

        $this->AlumnosService = $AlumnosService;

    }

    public function datatables(Request $request): JsonResponse
    {
        $result = $this->AlumnosService->datatables($request);
        return $this->datatablesResponse($result);
    }

    public function store(Request $request): JsonResponse
    {
        // dd($request);
        $result = $this->AlumnosService->store($request);

        return $this->successResponse($result,"Alumno registrado Correctamente");
    }

    public function update(Request $request, string $idempresa, string $idalumno): JsonResponse
    {
        $result = $this->AlumnosService->update($request, $idempresa, $idalumno);
        return $this->successResponse($result, "Alumno actualizado correctamente");
    }

    public function delete(string $idempresa, string $idalumno): JsonResponse
    {
        $result = $this->AlumnosService->delete($idempresa, $idalumno);

        return $this->successResponse($result, "El Alumno seleccionado se ha eliminado correctamente.");
    }

    public function show(string $idempresa, string $idalumno): JsonResponse
    {
        $result = $this->AlumnosService->show($idempresa, $idalumno);

        return $this->successResponse($result,"El Alumno seleccionado a traido los datos correctamente");
    }
}
