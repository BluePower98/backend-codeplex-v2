<?php

namespace App\Services\Application\Cursos\Instructores;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Proveedores\ProveedoresResource;
use App\Http\Resources\Proveedores\ProveedoresShowResource;
use App\Repositories\Inventory\InventoryRepositoryInterface;
use App\Repositories\Cursos\Cursos\CursosRepository;
use App\Repositories\Cursos\Instructores\InstructoresRepositoryInterface;
use App\Helpers\FileHelper;

class InstructoresService
{
    private InstructoresRepositoryInterface $InstructoresRepository;

    public function __construct(
        InstructoresRepositoryInterface $InstructoresRepository
    )
    {
        $this->InstructoresRepository = $InstructoresRepository;
    }

    public function datatables(Request $request): Collection
    {
        return $this->InstructoresRepository->datatables($request);
    }

    public function store(Request $request): void
    {
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

            $this->InstructoresRepository->store($request->all());
        }

    }

    public function update(Request $request, string $idempresa, int $idinstructor): Collection
    {
        return $this->InstructoresRepository->update($request->all(), $idempresa, $idinstructor);
    }

    public function delete(string $idempresa, int $idinstructor): Collection
    {
        return $this->InstructoresRepository->delete($idempresa, $idinstructor);
    }

    public function show(string $idempresa, int $idinstructor): Collection
    {
        return $this->InstructoresRepository->show($idempresa, $idinstructor);
    }

}
