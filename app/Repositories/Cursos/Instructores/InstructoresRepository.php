<?php

namespace App\Repositories\Cursos\Instructores;

use App\Models\Instructores;
use App\Repositories\BaseRepository;
use App\Repositories\Cursos\Instructores\Builders\InstructoresDatatablesQueryBuilder;
use Exception;
use App\Helpers\QueryHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class InstructoresRepository extends BaseRepository implements InstructoresRepositoryInterface
{
    public function __construct(Instructores $model)
    {
        parent::__construct($model);
    }

    public function datatables(Request $request): Collection
    {
        $results = (new InstructoresDatatablesQueryBuilder($this->model, $request))->getData();

        return collect($results);
    }

    public function store(array $params): Collection
    {

        $result= DB::statement('EXEC lo_Man_cur_instructores ?,?,?,?,?,?,?,?',
            ['M01',$params['idempresa'],
            isset($params['idinstructor'])?$params['idinstructor']:'',
            $params['apellidos'],
            $params['nombres'],
            $params['foto'],
            $params['detalle'],
            $params['activo']]
        );

        return collect($result);
    }

    public function update(array $params, string $idempresa, int $idinstructor): Collection
    {
        $result= DB::statement('EXEC lo_Man_cur_instructores ?,?,?,?,?,?,?,?',
        ['M02', $idempresa,$idinstructor,
        $params['apellidos'],
        $params['nombres'],
        $params['foto'],
        $params['detalle'],
        $params['activo']]
    );

    return collect($result);
    }

    public function delete(string $idempresa, int $idinstructor): Collection
    {
        $result= DB::statement('EXEC lo_Man_cur_instructores ?,?,?',
        ['M03', $idempresa,$idinstructor]
    );

        return collect($result);
    }

    public function show(string $idempresa, int $idinstructor): Collection
    {

        $result= DB::select('EXEC lo_Man_cur_instructores ?,?,?',
        ['S02', $idempresa,$idinstructor]
    );

        return collect($result);
    }

}
