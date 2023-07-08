<?php

namespace App\Http\Controllers\Api\V1\Logistic\Maintainers\Proveedor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\Proveedor;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Application\Proveedores\ProveedoresService;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Proveedores\ProveedoresStoreRequest;
// use App\Services\Application\Proveedores\ProveedoresSaveService;

class ProveedoresController extends ApiController
{
    private ProveedoresService $ProveedoresService;
    // private ProveedoresSaveService $ProveedoresSaveService;

    public function __construct(
        ProveedoresService $ProveedoresService,
        // ProveedoresSaveService $ProveedoresSaveService,
    )
    {
        $this->ProveedoresService = $ProveedoresService;
        // $this->ProveedoresSaveService =  $ProveedoresSaveService;
    }

    public function datatables(Request $request): JsonResponse
    {
        $result = $this->ProveedoresService->datatables($request);

        return $this->datatablesResponse($result);

    }

    public function store(Request $request): JsonResponse
    {
        $this->ProveedoresService->store($request);

        return $this->showMessage("Proveedor registrado Correctamente", Response::HTTP_CREATED);
    }

    public function update(Request $request, string $idempresa, int $rucdni): JsonResponse
    {

        $result = $this->ProveedoresService->update($request, $idempresa, $rucdni);

        return $this->successResponse($result, "Proveedor actualizado Correctamente");
    }

    public function delete(string $idempresa, string $rucdni): JsonResponse
    {
        $result = $this->ProveedoresService->delete($idempresa, $rucdni);

        return $this->successResponse($result,"El Proveedor seleccionado se ha eliminado correctamente.");
    }

    public function show(string $idempresa, string $rucdni): JsonResponse
    {
        $result = $this->ProveedoresService->show($idempresa, $rucdni);

        return $this->successResponse($result,"El Proveedor seleccionado a traido los datos correctamente");
    }

    public function searchUbigeo(string $idubigeo): JsonResponse
    {
       
        $result = $this->ProveedoresService->searchUbigeo($idubigeo);
        return $this->successResponse($result);
    }
}
