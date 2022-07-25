<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\School;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::paginate(10);
        return view('students.index')->withStudents($students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schools = School::all();
        return view('students.create')->withSchools($schools);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $studentBySchool = Student::where('school_id', $request->school_id);

        if ($studentBySchool->count() > 0) {
            $lastID = $studentBySchool->orderby('order', 'desc')->first();
            $order = ($lastID->order +1);
        } else {
            $order = 1;
        }

        $student = new Student();
        $student->name = $request->name;
        $student->school_id = $request->school_id;
        $student->order = $order;
        $student->save();

        return redirect()->back();
    }

    public function edit(Student $student)
    {
        //
    }

    public function update(Request $request,$id)
    {
        $student = new Student();
        $student->name = $request->name;
        $student->school_id = $request->school_id;
        $student->order = $order;
        $student->save();

        return redirect()->back();
    }

    public function trashed()
    {
        $schools = Student::onlyTrashed()->paginate(10);
        return view('students.trached')->withSchools($schools);
    }

    public function destroy($id)
    {
        $school = School::find($id);
        $school->delete();

        return redirect()->back();
    }
}
