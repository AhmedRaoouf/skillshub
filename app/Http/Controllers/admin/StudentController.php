<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        
        $data['students'] = User::where()->paginate(10);
        return view('admin/students/index',$data);
    }

    public function showScores($id)
    {
        $student = User::findOrFail($id);
        if ($student->role->name !== 'student') {
            return back();
        }
        $data['student'] = $student;
        $data['exams'] = $student->exams;
        return view('admin/students/show-scores',$data);
    }

    public function openExam($studentId,$examId)
    {
        $student = User::findOrFail($studentId,);
        $student->exams()->updateExistingPivot($examId,[
            'status' => 'opened',
        ]);
        return back();
    }

    public function closeExam($studentId,$examId)
    {
        $student = User::findOrFail($studentId,);
        $student->exams()->updateExistingPivot($examId,[
            'status' => 'closed',
        ]);
        return back();
    }
}
