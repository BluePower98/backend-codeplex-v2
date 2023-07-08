<?php

namespace App\Http\Resources\Proveedores;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProveedoresResource extends JsonResource
{
     /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */

     public function toArray($request): array
     {
        return [
            "idempresa" => $this->idempresa,
            "rucdni" => $this->rucdni,
            "codigo" => $this->codigo,
            "idtipodocidentidad" => $this->idtipodocidentidad,
            "razonsocial" => $this->razonsocial,
            "nombrecomercial" => $this->nombrecomercial,
            "telefono" => $this->telefono,
            "direccion" => $this->direccion,
            "email" => $this->email,
            "ubigeo" => $this->ubigeo,
            "activo" => $this->activo,
            "estadosunat" => $this->estadosunat,
            "idsunatt35" => $this->idsunatt35,
            "idtipoproveedor" => $this->idtipoproveedor
        ];
     }
}