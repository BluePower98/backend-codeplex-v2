<?php

namespace App\Repositories\Cursos\Especialidades;

use App\Models\Especialidades;
use App\Repositories\BaseRepository;
use App\Repositories\Cursos\Especialidades\Builders\EspecialidadesDatatablesQueryBuilder;
use Exception;
use App\Helpers\QueryHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class EspecialidadesRepository extends BaseRepository implements EspecialidadesRepositoryInterface
{
    public function __construct(Especialidades $model)
    {
        parent::__construct($model);
    }

    public function datatables(Request $request): Collection
    {
        $results = (new EspecialidadesDatatablesQueryBuilder($this->model, $request))->getData();

        return collect($results);
    }

    public function store(array $params): Collection
    {
        $result= DB::statement('EXEC lo_man_cur_especialidades ?,?,?,?,?',
            ['M01',$params['idempresa'],
            $params['idespecialidad'],
            $params['descripcion'],
            $params['activo']]        
        );

        return collect($result);
    }

    public function update(array $params, string $idempresa, int $idespecialidad): Collection
    {
        $result= DB::statement('EXEC lo_man_cur_especialidades ?,?,?,?,?',
        ['M02', $idempresa,$idespecialidad,
        $params['descripcion'],
        $params['activo']]        
    );
    
    return collect($result);
    }   

    public function delete(string $idempresa, int $idespecialidad): Collection
    {
        $result= DB::statement('EXEC lo_man_cur_especialidades ?,?,?',
        ['M03', $idempresa,$idespecialidad]        
    );

        return collect($result);    
    }

    public function show(string $idempresa, int $idespecialidad): Collection
    {
       
        $result= DB::select('EXEC lo_man_cur_especialidades ?,?,?',
        ['S02', $idempresa,$idespecialidad]        
    );

        return collect($result);    
    }
}
