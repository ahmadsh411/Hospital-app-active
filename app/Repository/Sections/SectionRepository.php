<?php

namespace App\Repository\Sections;

use App\Interfaces\Sections\SectionRepositoryInterface as SectionRepositoryInterface;
use App\Models\Doctors\Doctor;
use App\Models\Sections\Section;


class SectionRepository implements SectionRepositoryInterface
{
    public function index()
    {
        $sections = Section::all();

        return view('Dashboard.Sections.index', compact('sections'));
    }

    // TODO: Implement store() method.
    public function store($request)
    {
        $section = new Section();
        $section->name = $request->name;
        $section->description = $request->description;
        $section->save();
//       toastr()->success('Successfully Add New Section');
        session()->flash('add');
        return redirect()->route('section.all');
    }

    // TODO: Implement update() method.
    public function update($request, $id)
    {
        $section = Section::findOrFail($id);
        $section->update([
            'name' => $request->name,
            'description'=>$request->description,
        ]);
//           toastr()->info('Successfully Update The Section');
        session()->flash('edit');

        return redirect()->route('section.all');
    }

    // TODO: Implement destroy() method.

    public function destroy($id)
    {
        $section = Section::findOrFail($id);
        $section->delete();
//      toastr()->error('SUccessully Delete The Section');
        session()->flash('delete');
        return redirect()->back();
    }


    public function show($id)
    {
        $section = Section::findOrFail($id);
        return view('Dashboard.Sections.show-doctors', compact('section'));
    }
}
