<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'zg_proveedores';
    protected $primaryKey = "idempresa";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        "idempresa",
        "rucdni",
        "codigo",
        "idtipodocidentidad",
        "razonsocial",
        "nombrecomercial",
        "telefono",
        "direccion",
        "email",
        "ubigeo",
        "activo",
        "estadosunat",
        "idsunatt35",
        "idtipoproveedor",
       
    ];
}
