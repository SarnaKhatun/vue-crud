<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{

    public function index()
    {
        $students = Student::all();
        if ($students->count() > 0) {
            return response()->json([
                'status' => 200,
                'students' => $students,
            ], 200);
        }
        else{
            return response()->json([
                'status' => 404,
                'students' => 'No records Found',
            ], 404);
        }

    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|unique:students,email',
            'phone' => 'required',
         ]);

         if($validator->fails())
         {
            return response()->json([
                'status' => 422,
                'errors'=> $validator->messages(),
            ], 422);
         }
         else{
            $students = Student::create([
                'name' => $request->name,
                'address' => $request->address,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
            if($students){
                return response()->json([
                    'status' => 200,
                    'message'=> 'Student Added Successfully',
                ], 200);
            }
            else{
                return response()->json([
                    'status' => 500,
                    'message'=> 'Something went wrong',
                ], 500);
            }
         }
    }

    public function show($id)
    {
        $student = Student::find($id);
        if ($student)
        {
            return response()->json([
                'status' => 200,
                'student'=> $student,
            ], 200);
        }
        else {
            return response()->json([
                'status' => 404,
                'message'=> 'No Such Student Found!',
            ], 404);
        }
    }

    public function edit($id)
    {
        $student = Student::find($id);
        if ($student)
        {
            return response()->json([
                'status' => 200,
                'student'=> $student,
            ], 200);
        }
        else {
            return response()->json([
                'status' => 404,
                'message'=> 'No Such Student Found!',
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|unique:students,email',
            'phone' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status' => 422,
                'errors'=> $validator->messages(),
            ], 422);
        }
        else{

            $student = Student::find($id);
            $student->update([
                'name' => $request->name,
                'address' => $request->address,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
            if($student){
                return response()->json([
                    'status' => 200,
                    'message'=> 'Student Updated Successfully',
                ], 200);
            }
            else{
                return response()->json([
                    'status' => 404,
                    'message'=> 'Something went wrong',
                ], 404);
            }
        }
    }



    public function destroy($id)
    {
        $student = Student::find($id);
        if ($student)
        {
            $student->delete();
            return response()->json([
                'status' => 200,
                'message'=> 'Student Deleted Successfully',
            ], 200);
        }
        else {
            return response()->json([
                'status' => 404,
                'message'=> 'No Such Student Found!',
            ], 404);
        }
    }

}
