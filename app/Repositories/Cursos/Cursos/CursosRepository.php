<?php

namespace App\Repositories\Cursos\Cursos;

use App\Models\Cursos;
use App\Repositories\BaseRepository;
use App\Repositories\Cursos\Cursos\Builders\CursosDatatablesQueryBuilder;
use Exception;
use App\Helpers\QueryHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CursosRepository extends BaseRepository implements CursosRepositoryInterface
{
    public function __construct(Cursos $model)
    {
        parent::__construct($model);
    }

    public function datatables(Request $request): Collection
    {
        $results = (new CursosDatatablesQueryBuilder($this->model, $request))->getData();

        return collect($results);
    }

    public function store(array $params): Collection
    {
        // dd($params);
        $result= DB::statement('EXEC lo_cur_cur_cursos ?,?,?,?,?,?',
            ['M01',$params['idempresa'],
            isset($params['idcurso'])?$params['idcurso']:'',
            $params['idespecialidad'],
            $params['descripcion'],
            $params['activo']]        
        );

        return collect($result);
    }

    public function update(array $params, string $idempresa, int $idcurso): Collection
    {
        $result= DB::statement('EXEC lo_cur_cur_cursos ?,?,?,?,?,?',
        ['M02', $idempresa,$idcurso,
        $params['idespecialidad'],
        $params['descripcion'],
        $params['activo']]        
    );

    return collect($result);
    }   

    public function delete(string $idempresa, int $idcurso): Collection
    {
        $result= DB::statement('EXEC lo_cur_cur_cursos ?,?,?',
        ['M03', $idempresa,$idcurso]        
    );

        return collect($result);    
    }

    public function show(string $idempresa, int $idcurso): Collection
    {
       
        $result= DB::select('EXEC lo_cur_cur_cursos ?,?,?',
        ['S02', $idempresa,$idcurso]        
    );

        return collect($result);    
    }

    public function getEspecialidades(string $idempresa): Collection
    {
      $result= DB::select('EXEC lo_cur_cur_cursos ?,?',
      ['CB1', $idempresa]
      );

      return collect($result);
    }

}