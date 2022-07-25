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
        $students = Student::orderby('school_id', 'DESC')->get();
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
        $studentByStudent = Student::where('school_id', $request->school_id);

        if ($studentByStudent->count() > 0) {
            $lastID = $studentByStudent->orderby('order', 'desc')->first();
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
        $schools = School::all();
        return view('students.create')->withSchools($schools);
    }

    public function update(Request $request,$id)
    {
        $student = Student::find($id);
        $student->name = $request->name;
        $student->school_id = $request->school_id;

        if ($student->school_id != $student->school_id) {
            $studentByStudent = Student::where('school_id', $request->school_id);

            if ($studentByStudent->count() > 0) {
                $lastID = $studentByStudent->orderby('order', 'desc')->first();
                $student->order = ($lastID->order +1);
            } else {
                $student->order = 1;
            }
        }
        $student->update();

        return redirect()->back();
    }

    public function trashed()
    {
        $schools = Student::onlyTrashed()->paginate(10);
        return view('students.trached')->withStudents($schools);
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        Student::where('school_id', $student->school_id)->where('order','>', $student->order)->update([
            'order' => \DB::raw('`order`-1')
        ]);
        

        $student->delete();

        return redirect()->back();
    }

    public function restore($id)
    {
        $student = Student::withTrashed()->find($id);

        Student::where('id', '!=', $id)->
        where('school_id', $student->school_id)
        ->where('order','>=', $student->order)
        ->update([
            'order' => \DB::raw('`order`+1')
        ]);

        $student->restore();

        return redirect()->back();
    }

    public function forceDelete($id)
    {
        $school = Student::withTrashed()->find($id)->forceDelete();

        return redirect()->back();
    }
}
