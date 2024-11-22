<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function storeStudent(Request $request){
        $validatedData = $request->validate([
            'name' =>'required|string|max:255',
            'gender' =>'required|string'
        ], [], [], 'addStudents');
        
        $student = Student::create([
            'name' => $validatedData['name'],
            'gender' => $validatedData['gender'],
        ]);
        if(!$student){
            return redirect()->back()->with('error', 'Failed to create student.');
        }
        return redirect('/dashboard/students')->with('success', 'Student created successfully.');
    }
    public function dashboard()
    {
        if (Auth::check()) {
            $user = Auth::user(); // Get the logged-in user
            // Return the dashboard view with user data
            return view('dashboard')->with('user', $user);
        }

        // Redirect to login if the user is not logged in
        return redirect()->route('login')->with('error', 'You need to log in first.');
    }
    public function getAllStudents(){
        
        // get all student and theri score by join both tables
        $students = Student::leftJoin('score', 'students.student_id', '=', 'score.student_id')
                           ->select('students.student_id as s_id', 'students.*', 'score.*')
                           ->where(function ($query) {
                               $query->whereMonth('score.created_at', Carbon::now()->month)
                                     ->whereYear('score.created_at', Carbon::now()->year);
                           })
                           ->orWhereNull('score.student_id') // Include students with no scores
                           ->get();
        

        // $students = Student::all();
        return view('components.student', compact('students'));
    }

    public function removeStudent($id){
        $student = Student::find($id);
        if($student){
            $student->delete();
            return redirect('/dashboard/students')->with('success', 'Student deleted successfully.');
        }
        return redirect()->back()->with('error', 'Failed to delete student.');
    }
}
