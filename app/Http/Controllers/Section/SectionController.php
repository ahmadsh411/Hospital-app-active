<?php

namespace App\Http\Controllers\Section;

use App\Http\Controllers\Controller;
use App\Http\Requests\Section\SectionRequest;
use App\Interfaces\Sections\SectionRepositoryInterface;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    private $sectionRepository;
    public function __construct(SectionRepositoryInterface $sectionRepository )
    {
     $this->sectionRepository=$sectionRepository;
    }

    public function index()
    {
      return $this->sectionRepository->index();
    }


    public function create()
    {
        //
    }


    public function store(SectionRequest $request)
    {
      return $this->sectionRepository->store($request);
    }


    public function show($id)
    {
        return $this->sectionRepository->show($id);
    }


    public function edit($id)
    {
        //
    }


    public function update(SectionRequest $request, $id)
    {
       return $this->sectionRepository->update($request,$id);

    }


    public function destroy($id)
    {
        return $this->sectionRepository->destroy($id);
    }
}
