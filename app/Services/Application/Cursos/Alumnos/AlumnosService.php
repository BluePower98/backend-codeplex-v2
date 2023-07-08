<?php

namespace App\Services\Application\Cursos\Alumnos;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Proveedores\ProveedoresResource;
use App\Http\Resources\Proveedores\ProveedoresShowResource;
use App\Repositories\Inventory\InventoryRepositoryInterface;
use App\Repositories\Cursos\Alumnos\AlumnosRepository;
use App\Repositories\Cursos\Alumnos\AlumnosRepositoryInterface;
use App\Helpers\FileHelper;

class AlumnosService
{
    private AlumnosRepositoryInterface $AlumnosRepository;

    public function __construct(

        AlumnosRepositoryInterface $AlumnosRepository
    )
    {
        $this->AlumnosRepository = $AlumnosRepository;
    }

    public function datatables(Request $request): Collection
    {
        return $this->AlumnosRepository->datatables($request);
    }

    public function store(Request $request): void
    {
        // dd($request);
        $logo=$request->only(['foto']);
        $this->saveLogo($request,$logo);

    }

    private function saveLogo(Request $request,array $logo)
    {
        $images=array_keys($logo);
        $upload_path=$request->get('upload_path').'/';
        FileHelper::removeByUrl($upload_path);
        // dd($images);
        foreach ($images as $value) {

            if(!$request->hasFile($value)){
                  // dd('sddssd',$request->hasFile($value));
                continue;
            }
            $file=$request->file($value);
            // $fileName = FileHelper::sanitizerFileName($file->getClientOriginalName());
            // dd($fileName);
            $fileName = "foto" . '.' . $file->getClientOriginalExtension();
            $file->move($upload_path, $fileName);

            $url = $upload_path.'/'. $fileName;

            // $this->repository->updatelogo([

            //     'idempresa' => $idempresa,
            //     'idalumno' => $idalumno,
            //     'foto' => $url
            // ]);

            $request->merge(["foto"=>$url]);
              // dd($request->all());
              // return;
            $this->AlumnosRepository->store($request->all());
        }

    }

    public function update(Request $request, string $idempresa, string $idalumno): Collection
    {
        return $this->AlumnosRepository->update($request->all(), $idempresa, $idalumno);
    }

    public function delete(string $idempresa, string $rucdni): Collection
    {
        return $this->AlumnosRepository->delete($idempresa, $rucdni);
    }
    public function show(string $idempresa, string $idalumno): Collection
    {
        return $this->AlumnosRepository->show($idempresa, $idalumno);
    }
}
