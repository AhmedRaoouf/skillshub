<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExamResource;
use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    public function show($id)
    {
        $exam = Exam::find($id);
        if ($exam) {
            return new ExamResource($exam);
        } else {
            return response()->json(['message' => 'Exam not found'], 404);
        }
    }
    public function showQuestions($id)
    {
        $exam = Exam::with('questions')->find($id);
        if ($exam) {
            return new ExamResource($exam);
        } else {
            return response()->json(['message' => 'Exam not found'], 404);
        }
    }

    public function start($examId,Request $request)
    {
        $user = $request->user();
        if (! $user->exams->contains($examId)) {
            $user->exams()->attach($examId);
        }else {
            $user->exams()->updateExistingPivot($examId,[
                'status' => 'closed',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        return response()->json([
            'message' => "you started exam"
        ]);
    }

    public function submit($examId, Request $request)
    {

        $validator = Validator::make($request->all() ,[
            "answers" => "required|array",
            "answers.*" => "required|in:1,2,3,4",
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

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
        $user = $request->user();
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
        return response()->json([
            "message" => "You submitted the exam successfully and your score is $score"
        ]);
    }

}
