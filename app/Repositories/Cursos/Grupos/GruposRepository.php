<?php

namespace App\Repositories\Cursos\Grupos;

use App\Models\Grupos;
use App\Repositories\BaseRepository;
use App\Repositories\Cursos\Grupos\Builders\GruposDatatablesQueryBuilder;
use Exception;
use App\Helpers\QueryHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class GruposRepository extends BaseRepository implements GruposRepositoryInterface
{
    public function __construct(Grupos $model)
    {
        parent::__construct($model);
    }

    public function datatables(Request $request): Collection
    {
        $results = (new GruposDatatablesQueryBuilder($this->model, $request))->getData();

        return collect($results);
    }

    public function store(array $params): Collection
    {
        $result= DB::statement('EXEC lo_Man_cur_grupos ?,?,?,?,?,?,?,?,?,?,?,?,?',
            ['M01',$params['idempresa'],
            $params['idgrupo'],
            $params['idcurso'],
            $params['nombre'],
            $params['fecha_inicio'],
            $params['fecha_fin'],
            $params['duracion'],
            $params['horario'],
            $params['beneficios'],
            $params['costo'],
            $params['idmoneda'],
            $params['activo']]
        );

        return collect($result);
    }

    public function update(array $params, string $idempresa, int $idgrupo): Collection
    {
        $result= DB::statement('EXEC lo_Man_cur_grupos ?,?,?,?,?,?,?,?,?,?,?,?,?',
            ['M02',$idempresa,$idgrupo,
            $params['idcurso'],
            $params['nombre'],
            $params['fecha_inicio'],
            $params['fecha_fin'],
            $params['duracion'],
            $params['horario'],
            $params['beneficios'],
            $params['costo'],
            $params['idmoneda'],
            $params['activo']]
        );

        return collect($result);
    }

    public function delete(string $idempresa, int $idgrupo): Collection
    {
        $result= DB::statement('EXEC lo_Man_cur_grupos ?,?,?',
        ['M03', $idempresa,$idgrupo]
    );

        return collect($result);
    }

    public function show(string $idempresa, int $idgrupo): Collection
    {

        $result= DB::select('EXEC lo_Man_cur_grupos ?,?,?',
        ['S02', $idempresa,$idgrupo]
    );

        return collect($result);
    }

    public function getCursos(string $idempresa): Collection
    {
      $result= DB::select('EXEC lo_Man_cur_grupos ?,?',
      ['CB1', $idempresa]
      );

      return collect($result);
    }

    public function getMondedas(): Collection
    {
      $result= DB::select('EXEC lo_Man_cur_grupos ?',
      ['CB2']
      );

      return collect($result);
    }
}
