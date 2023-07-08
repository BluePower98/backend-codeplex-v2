<?php

namespace App\Repositories\Proveedores\Builders;

use Exception;
use App\Models\Proveedor;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProveedoresDatatablesQueryBuilder 
{
    private Proveedor $model;
    private Request $request;
    private Builder $query;

    public function __construct(Proveedor $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

        /**
     * @return mixed
     * @throws Exception
     */

    public function getData(): mixed
    {
        $this->settingQueryBuilder();

        return Datatables::query($this->query)
        ->make(true)
        ->getData();
    }

     private function settingQueryBuilder(): void {
        $this->query = DB::table("{$this->model->getTable()} AS T1")
            ->select([
                DB::raw("T1.idempresa"),
                DB::raw("ISNULL(T1.rucdni,'')  AS rucdni"),
                DB::raw("ISNULL(T1.razonsocial,'') AS razonsocial"),
                DB::raw("ISNULL(T1.email,'') AS email"),
                DB::raw("ISNULL(T1.activo,'')  AS activo"),
                DB::raw("(CASE t1.estadosunat  When 0 Then 'HABIDO' When 1 Then 'NO HABIDO' Else 'DE BAJA' End ) AS estadosunat "),

            ])
            ->Join('st_tiposdocumentoidentidad AS Z',function(JoinClause $join){
                $join->on('Z.idtipodocidentidad','=','T1.idtipodocidentidad');
            });
            $this->addFilters();
     }

     private function addFilters(): void {
        if ($idempresa = $this->request->get('idempresa')) {
            $this->query = $this->query->where('T1.idempresa', $idempresa)
            ->where('T1.idtipoproveedor', 1);
        }

        
     }
}