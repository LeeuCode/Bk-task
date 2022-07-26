<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SchoolResource;
use App\Models\School;

class SchoolController extends Controller
{
    public function index()
    {
        $data = School::latest()->get();
        return response()->json([
            'status' => 200,
            'msg' => 'successful data',
            'data' => SchoolResource::collection($data)
        ]);
    }

    public function store(Request $request)
    {
        $data = School::create($request->all());

        return response()->json([
            'status' => 201,
            'msg' => 'Create New School',
            'data' => [$data] //SchoolResource::collection()
        ]);
    }

    public function update(Request $request, $id)
    {
        $school = School::find($id);
        $school->name = $request->name;
        $school->update();

        return response()->json([
            'status' => 201,
            'msg' => 'Successful update School',
            'data' => [$school] //SchoolResource::collection()
        ]);
    }

    public function delete($id)
    {
        $school = School::find($id);
        $school->delete();

        return response()->json([
            'status' => 200,
            'msg' => 'Successful delete School',
            'data' => [] //SchoolResource::collection()
        ]);
    }

    public function restore($id)
    {
        $school = School::withTrashed()->find($id)->restore();

        return response()->json([
            'status' => 200,
            'msg' => 'Successful restore School',
            'data' => [] //SchoolResource::collection()
        ]);
    }

    public function forceDelete($id)
    {
        $school = School::withTrashed()->find($id)->forceDelete();

        return response()->json([
            'status' => 200,
            'msg' => 'School deleted',
            'data' => [] //SchoolResource::collection()
        ]);
    }
}
