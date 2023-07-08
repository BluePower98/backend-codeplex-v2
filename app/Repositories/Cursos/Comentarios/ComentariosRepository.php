<?php

namespace App\Repositories\Cursos\Comentarios;

use App\Models\Comentarios;
use App\Repositories\BaseRepository;
use App\Repositories\Cursos\Comentarios\Builders\ComentariosDatatablesQueryBuilder;
use Exception;
use App\Helpers\QueryHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ComentariosRepository extends BaseRepository implements ComentariosRepositoryInterface
{
    public function __construct(Comentarios $model)
    {
        parent::__construct($model);
    }

    public function datatables(Request $request): Collection
    {
        $results = (new ComentariosDatatablesQueryBuilder($this->model, $request))->getData();

        return collect($results);
    }

    public function store(array $params): Collection
    {
        // dd($params);
        $result= DB::statement('EXEC lo_Man_cur_comentarios ?,?,?,?,?,?',
            ['M01',$params['idempresa'],
            $params['idcomentarios'],
            $params['email'],
            $params['mensaje'],
            $params['fecha']]
        );
  
        return collect($result);
    }

    public function update(array $params, string $idempresa, int $idcomentarios): Collection
    {
        $result= DB::statement('EXEC lo_Man_cur_comentarios ?,?,?,?,?,?',
        ['M02', $idempresa,$idcomentarios,
        $params['email'],
        $params['mensaje'],
        $params['fecha']]
    );

    return collect($result);
    }

    public function delete(string $idempresa, int $idcomentarios): Collection
    {
        $result= DB::statement('EXEC lo_Man_cur_comentarios ?,?,?',
        ['M03', $idempresa,$idcomentarios]
    );

        return collect($result);
    }

    public function show(string $idempresa, int $idcomentarios): Collection
    {

        $result= DB::select('EXEC lo_Man_cur_comentarios ?,?,?',
        ['S02', $idempresa,$idcomentarios]
    );

        return collect($result);
    }
}
