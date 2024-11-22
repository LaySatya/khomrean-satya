<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function storeStudentScore(Request $request){
    //    dd($request);
        $request->validate([
            'attendance' =>'required|numeric',
            'book' =>'required|numeric',
            'homework' =>'required|numeric',
            'activity' =>'required|numeric',
            'quiz' =>'required|numeric',
            'exam' =>'required|numeric',
        ], [], [], 'addScore');

        $score = Score::create([
            'attendance' => $request->attendance,
            'book' => $request->book,
            'homework' => $request->homework,
            'activity' => $request->activity,
            'quiz' => $request->quiz,
            'exam' => $request->exam,
            'student_id' => $request->student_id
        ]);
        if(!$score){
            return redirect()->back()->with('error','Failed to add score.');
        }
        return redirect('/dashboard/students')->with('success','Score added successfully.');
    }
}
