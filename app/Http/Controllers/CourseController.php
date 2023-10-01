<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //
    public function courseEnrollment(Request $request) {
        $input = request()->validate([
            'title' => 'required',
        ]);

        auth()->user()->courses()->create($input);

        return response()->json([
            'status'=> 200,
            'message' => 'Course Created'
        ], 200);
    }

    public function totalCourses() {
        $id = auth()->user()->id;
        $courses = User::find($id)->courses;

        return response()->json([
            'status' => 200,
            'message' => "All courses",
            "courses" => $courses
        ]);
    }

    public function deleteCourse() {
        
    }
}
