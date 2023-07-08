<?php

namespace App\Repositories\Cursos\Especialidades\Builders;

use Exception;
use App\Models\Especialidades;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class EspecialidadesDatatablesQueryBuilder
{
    private Especialidades $model;
    private Request $request;
    private Builder $query;

    public function __construct(Especialidades $model, Request $request)
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
                DB::raw("ISNULL(T1.idespecialidad,'')  AS idespecialidad"),
                DB::raw("ISNULL(T1.descripcion,'') AS descripcion"),
                DB::raw("ISNULL(T1.activo,'')  AS activo"),

            ]);
            $this->addFilters();
     }

     private function addFilters(): void {
        if ($idempresa = $this->request->get('idempresa')) {
            $this->query = $this->query->where('T1.idempresa', $idempresa);
        }       
     }
}