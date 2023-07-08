<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructores extends Model
{
    protected $table = 'cur_instructores';
    protected $primaryKey = "idempresa";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        "idempresa",
        "idinstructor",
        "apellidos",
        "nombres",
        "foto",
        "detalle",
        "activo"
       
    ];
}