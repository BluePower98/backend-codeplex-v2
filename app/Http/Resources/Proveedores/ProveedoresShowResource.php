<?php

namespace App\Http\Resources\Proveedores;

use App\Helpers\FileHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class ProveedoresShowResource extends JsonResource
{
        /**
     * Transform the resource into an array.
     *
     * @param $request
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

    /**
     * @return array
     */

     private function includeImages(): array
     {
        $entryImages = $this->images ?: [];

        $provedores = $this;

        $images = [];

        foreach ($entryImages as $key => $image) {
            $propertyName = "imagen" . ($key + 1);

            $server = env('APP_URL');
            $localFile = str_replace($server, '', $image->imagen);
            $url = $server . $localFile;
            $pathLocalFile = public_path($localFile);

            if (!file_exists($pathLocalFile)) {
                continue;
            }

            if (property_exists($provedores, $propertyName)) {
                $provedores->{$propertyName} = $url;
            }

            $pathInfo = pathinfo($pathLocalFile);

            $images[] = [
                'url' => $url,
                'name' => $pathInfo['basename'],
                'type' => mime_content_type($pathLocalFile),
                'size' => strlen(file_get_contents($pathLocalFile)),
                'dataURL' => FileHelper::getDataURI($pathLocalFile),
            ];
        }

        return $images;
     }


}