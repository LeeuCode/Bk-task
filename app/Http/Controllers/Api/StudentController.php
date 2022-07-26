<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\StudentResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{

    public function index()
    {
        # code...
        $data = Student::latest()->get();
    
        return response()->json([
            'status' => 200,
            'msg' => 'successful data',
            'data' => StudentResource::collection($data)
        ]);
    }

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

        return response()->json([
            'status' => 200,
            'msg' => 'Create new student successful',
            'data' => [$student]
        ]);
    }

    public function update(Request $request, $id)
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

        return response()->json([
            'status' => 200,
            'msg' => 'Update student successful',
            'data' => [$student]
        ]);
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        Student::where('school_id', $student->school_id)->where('order','>', $student->order)->update([
            'order' => \DB::raw('`order`-1')
        ]);
        

        $student->delete();

        return response()->json([
            'status' => 200,
            'msg' => 'Successful delete Student',
            'data' => [] //SchoolResource::collection()
        ]);
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

        return response()->json([
            'status' => 200,
            'msg' => 'Successful restore Student',
            'data' => [] //SchoolResource::collection()
        ]);
    }

    public function forceDelete($id)
    {
        Student::withTrashed()->find($id)->forceDelete();

        return response()->json([
            'status' => 200,
            'msg' => 'Student deleted success',
            'data' => [] //SchoolResource::collection()
        ]);
    }
}
