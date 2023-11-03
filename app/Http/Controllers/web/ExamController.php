<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function show($id)
    {
        $data["exam"] = Exam::findOrFail($id);
        $user = Auth::user();
        $data["canViewStartBtn"] = true;

        if ($user !==  null) {
            $pivotRow = $user->exams()->where("exam_id",$id)->first();

            if ($pivotRow !== null and $pivotRow->pivot->status == "closed") {
                $data["canViewStartBtn"] = false;
            }
        }
        return view("web.exams.show", $data);
    }

    public function start($examId)
    {
        $user = Auth::user();
        if (! $user->exams->contains($examId)) {
            $user->exams()->attach($examId);
        }else {
            $user->exams()->updateExistingPivot($examId,[
                'status' => 'closed',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        session()->flash("prev","start/$examId");
        return redirect(url("exams/questions/$examId"));
    }

    public function questions($examId)
    {
        if (session('prev') !== "start/$examId") {
            return redirect(url("exams/show/$examId"));
        }
        $data["exam"] = Exam::findOrFail($examId);
        session()->flash("prev","questions/$examId");

        return view("web.exams.questions", $data);

    }



    public function submit($examId, Request $request)
    {
        if (session('prev') !== "questions/$examId") {
            return redirect(url("exams/show/$examId"));
        }
        $request->validate([
            "answers" => "required|array",
            "answers.*" => "required|in:1,2,3,4",
        ]);

        //Calculation Score
        $exam = Exam::findOrFail($examId);
        $points = 0;
        $totalQuesNum = $exam->questions->count();

        foreach ($exam->questions as $question) {
            if (isset($request->answers[$question->id])) {
                $userAns = $request->answers[$question->id];
                $rightAns = $question->right_answer;

                if ($userAns == $rightAns) {
                    $points += 1;
                }
            }
        }
        $score = ($points / $totalQuesNum) * 100;
        //calculating Time Mins
        $user = Auth::user();
        $pivotRow = $user->exams()->where("exam_id", $examId)->first();
        $startTime = $pivotRow->pivot->created_at;
        $submitTime = Carbon::now();

        $timeMins = $submitTime->diffInMinutes($startTime);

        if ($timeMins > $pivotRow->duration_mins) {
            $score  = 0;
        }
        // Update Pivot Row
        $user->exams()->updateExistingPivot($examId, [
            "score" => $score,
            "time_mins" => $timeMins,
            "status" => "closed",
        ]);
        $request->session()->flash("success","you finish exam successfully with score $score% ");
        return redirect(url("/exams/show/{$examId}"));
    }
}
