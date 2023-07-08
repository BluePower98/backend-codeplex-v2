<?php

namespace App\Repositories\Proveedores;

use App\Models\Proveedor;
use App\Repositories\BaseRepository;
use App\Repositories\Proveedores\Builders\ProveedoresDatatablesQueryBuilder;
use Exception;
use App\Helpers\QueryHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class ProveedoresRepository extends BaseRepository implements ProveedoresRepositoryInterface
{
    public function __construct(Proveedor $model)
    {
        parent::__construct($model);
    }

    public function datatables(Request $request): Collection
    {
        $results = (new ProveedoresDatatablesQueryBuilder($this->model, $request))->getData();

        return collect($results);
    }

    public function store(array $params): Collection
    {
        // dd($params);
        $result= DB::select('EXEC Lo_Man_zg_proveedores ?,?,?,?,?,?,?,?,?,?,?,?,?,?',
            ['M01',$params['idempresa'],
            $params['rucdni'],
            $params['codigo'],
            $params['idtipodocidentidad'],
            $params['razonsocial'],
            $params['nombrecomercial'],
            $params['telefono'],
            $params['direccion'],
            $params['email'],
            $params['ubigeo'],
            $params['activo'],
            $params['estadosunat'],
            $params['idtipoproveedor']]        
        );

        return collect($result);
    }

    public function update(array $params, string $idempresa, int $rucdni): Collection
    {
        $result= DB::select('EXEC Lo_Man_zg_proveedores ?,?,?,?,?,?,?,?,?,?,?,?,?,?',
        ['M02', $idempresa,$rucdni,
        $params['codigo'],
        $params['idtipodocidentidad'],
        $params['razonsocial'],
        $params['nombrecomercial'],
        $params['telefono'],
        $params['direccion'],
        $params['email'],
        $params['ubigeo'],
        $params['activo'],
        $params['estadosunat'],
        $params['idtipoproveedor']]        
    );

    return collect($result);
    }

    public function delete(string $idempresa, string $rucdni): Collection
    {
        $result= DB::select('EXEC Lo_Man_zg_proveedores ?,?,?',
        ['M03', $idempresa,$rucdni]        
    );

        return collect($result);    
    }

    public function show(string $idempresa, string $rucdni): Collection
    {
        $result= DB::select('EXEC Lo_Man_zg_proveedores ?,?,?',
        ['S02', $idempresa,$rucdni]        
    );

        return collect($result);    
    }

    public function searchUbigeo(string $idubigeo): Collection
    {
        $result= DB::select('EXEC Lo_Man_zg_proveedores ?,?,?,?,?,?,?,?,?,?,?,?,?,?',
        ['S08',null,null,null,null,null,null,null,null,null,$idubigeo,null,null,null]
        
    );

    return collect($result);
    }
    


}