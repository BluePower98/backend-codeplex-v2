<?php

namespace App\Http\Controllers\Api\V1\Cursos\Maintainers\Instructores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\Cursos;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Application\Cursos\Instructores\InstructoresService;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Proveedores\ProveedoresStoreRequest;
// use App\Services\Application\Proveedores\ProveedoresSaveService;

class InstructoresController extends ApiController
{
    private InstructoresService $InstructoresService;

    public function __construct(
        InstructoresService $InstructoresService,
    )
    {
        $this->InstructoresService = $InstructoresService;
    }

    public function datatables(Request $request): JsonResponse
    {
        $result = $this->InstructoresService->datatables($request);

        return $this->datatablesResponse($result);
    }

    public function store(Request $request): JsonResponse
    {
        $this->InstructoresService->store($request);

        return $this->showMessage("Instructor registrado Correctamente", Response::HTTP_CREATED);
    }

    public function update(Request $request, string $idempresa, int $idinstructor): JsonResponse
    {

        $result = $this->InstructoresService->update($request, $idempresa, $idinstructor);

        return $this->successResponse($result, "Instructor actualizado Correctamente");
    }

    public function delete(string $idempresa, int $idinstructor): JsonResponse
    {
        $result = $this->InstructoresService->delete($idempresa, $idinstructor);

        return $this->successResponse($result,"El Instructor seleccionado se ha eliminado correctamente.");
    }

    public function show(string $idempresa, int $idinstructor): JsonResponse
    {
        $result = $this->InstructoresService->show($idempresa, $idinstructor);

        return $this->successResponse($result,"El Instructor  seleccionado a traido los datos correctamente");
    }
}
