<?php

namespace App\Http\Controllers\Api\V1\Cursos\Maintainers\Cursos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\Cursos;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Application\Cursos\Cursos\CursosService;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Proveedores\ProveedoresStoreRequest;
// use App\Services\Application\Proveedores\ProveedoresSaveService;

class CursosController extends ApiController
{
    private CursosService $CursosService;

    public function __construct(
        CursosService $CursosService,
        // ProveedoresSaveService $ProveedoresSaveService,
    ) 
    {
        $this->CursosService = $CursosService;
    }

    public function datatables(Request $request): JsonResponse
    {
        $result = $this->CursosService->datatables($request);

        return $this->datatablesResponse($result);

    }

    public function store(Request $request): JsonResponse
    {
        $this->CursosService->store($request);

        return $this->showMessage("Curso registrado Correctamente", Response::HTTP_CREATED);
    }

    public function update(Request $request, string $idempresa, int $idcurso): JsonResponse
    {

        $result = $this->CursosService->update($request, $idempresa, $idcurso);

        return $this->successResponse($result, "Curso actualizado Correctamente");
    }

    public function delete(string $idempresa, int $idcurso): JsonResponse
    {
        $result = $this->CursosService->delete($idempresa, $idcurso);

        return $this->successResponse($result,"El Curso seleccionado se ha eliminado correctamente.");
    }

    public function show(string $idempresa, int $idcurso): JsonResponse
    {
        $result = $this->CursosService->show($idempresa, $idcurso);

        return $this->successResponse($result,"El Curso seleccionado a traido los datos correctamente");
    }

    public function getEspecialidades(string $idempresa): JsonResponse
    {
        $result = $this->CursosService->getEspecialidades($idempresa);

        return $this->successResponse($result,"El Grupo seleccionado a traido los datos de Especialidades");
    }

}
