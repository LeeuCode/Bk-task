<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index()
    {
        $schools = School::paginate(10);
        return view('schools.index')->withSchools($schools);
    }

    public function create()
    {
        return view('schools.create');
    }

    public function store(Request $request)
    {
        $school = new School();
        $school->name = $request->name;
        $school->save();

        return redirect()->back();
    }

 
    public function edit($id)
    {
        $school = School::find($id);
        return view('schools.edit')->withSchool($school);
    }


    public function update(Request $request, $id)
    {
        $school = School::find($id);
        $school->name = $request->name;
        $school->update();

        return redirect()->back();
    }

    public function trashed()
    {
        $schools = School::onlyTrashed()->paginate(10);
        return view('schools.trached')->withSchools($schools);
    }

    public function destroy($id)
    {
        $school = School::find($id);
        $school->delete();

        return redirect()->back();
    }

    public function restore($id)
    {
        $school = School::withTrashed()->find($id)->restore();

        return redirect()->back();
    }

    public function forceDelete($id)
    {
        $school = School::withTrashed()->find($id)->forceDelete();

        return redirect()->back();
    }
}
