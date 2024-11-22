<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function getAllLessons(){
        $lessons = Lesson::all();
        return view('components.lesson-management',compact('lessons'));
    }
    public function getAllDataToClients(){
        $lessons = Lesson::all();
        $students = Student::leftJoin('score', 'students.student_id', '=', 'score.student_id')
                           ->select('students.student_id as s_id', 'students.*', 'score.*')
                           ->where(function ($query) {
                               $query->whereMonth('score.created_at', Carbon::now()->month)
                                     ->whereYear('score.created_at', Carbon::now()->year);
                           })
                           ->orWhereNull('score.student_id') // Include students with no scores
                           ->get();
        
        return view('welcome',compact('lessons', 'students'));
    }
    public function storeLessons(Request $request){

        $validateLessons = $request->validate([
            // video_url must be link of youtube
            'video_url' => 'required|url',
            'title' => 'required|string',
            'description' => 'required|string',
        ]);
        $lesson = Lesson::create($validateLessons);
        if(!$lesson){
            return redirect()->back()->with('error', 'Failed to create a new Lesson.');
        }
        return redirect('dashboard/courses')->with('success', 'Lesson created successfully.');
    }
    public function removeLesson($id){
        $lesson = Lesson::find($id);
        if(!$lesson){
            return redirect()->back()->with('error', 'Lesson not found.');
        }
        $lesson->delete();
        return redirect('dashboard/courses')->with('success', 'Lesson deleted successfully.');
    }
    public function updateLesson(Request $request, $id){
        $lesson = Lesson::find($id);
        if(!$lesson){
            return redirect()->back()->with('error', 'Lesson not found.');
        }
        $validateLessons = $request->validate([
            'video_url' => 'url',
            'title' => 'string',
            'description' => 'string',
        ]);
        $lesson->update($validateLessons);
        return redirect('dashboard/courses')->with('success', 'Lesson updated successfully.');
    }

}
