<?php

namespace App\Http\Controllers;

use App\Models\Course;
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

    public function deleteCourse($id) {
        $user_id = auth()->user()->id;

        $course = Course::findOrFail($id);

        if($course->user_id != $user_id) {
            return response()->json([
                'message'=>'you are not authorised to update this'
            ], 401);
        }

        $course->delete();
        return response()->json([
            "Message"=>"Deleted"
        ], 200);
    }
}
