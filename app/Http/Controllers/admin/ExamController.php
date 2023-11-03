<?php

namespace App\Http\Controllers\admin;

use App\Events\ExamAddedEvent;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExamController extends Controller
{
    public function index()
    {
        $data['exams'] = Exam::orderBy('id', 'Desc')->paginate(10);
        $data['skills'] = Skill::select('id', 'name')->get();
        return view('admin.exams.index', $data);
    }

    public function show(Exam $exam)
    {
        $data['exam'] = $exam;
        return view('admin.exams.show', $data);
    }

    public function showQuestions(Exam $exam)
    {
        $data['exam'] = $exam;
        return view('admin.exams.questions.show', $data);
    }

    public function create()
    {

        $data['skills'] = Skill::select('id', 'name')->get();
        return view('admin.exams.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => "required|string|max:255",
            'name_ar' => "required|string|max:255",
            'desc_en' => "required|string|max:5000",
            'desc_ar' => "required|string|max:5000",
            'image'   => "required|image|max:4096",
            'skill_id'  => "required|exists:skills,id",
            'questions_no' => "required|integer|min:1",
            'difficulty' => "required|integer|min:1,max:5",
            'duration_mins' => "required|integer|min:1",
        ]);

        $path = Storage::putFile('exams', $request->image);
        $exam = Exam::create([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'description' => json_encode([
                'en' => $request->desc_en,
                'ar' => $request->desc_ar,
            ]),
            'image' => $path,
            'skill_id' => $request->skill_id,
            'questions_no' => $request->questions_no,
            'duration_mins' => $request->duration_mins,
            'difficulty' => $request->difficulty,
            'active' => 0,
        ]);
        session()->flash('prev', "exams/$exam->id");
        return redirect("dashboard/exams/create-questions/$exam->id");
    }

    public function createQuestions(Exam $exam)
    {
        if (session('prev') !== "exams/$exam->id" and session('current') !== "exams/$exam->id") {
            return redirect('dashboard/exams');
        }
        $data['exam_id'] = $exam->id;
        $data['questions_no'] = $exam->questions_no;
        return view('admin.exams.questions.create', $data);
    }

    public function storeQuestions(Exam $exam , Request $request)
    {
        session()->flash('current', "exams/$exam->id");
        $request->validate([
            'title' => "required|array",
            'title.*' => "required|string|max:500",
            'right_anss' => "required|array",
            'right_anss.*' => "required|in:1,2,3,4",
            'option_1s' => "required|array",
            'option_1s.*' => "required|string|max:255",
            'option_2s' => "required|array",
            'option_2s.*' => "required|string|max:255",
            'option_3s' => "required|array",
            'option_3s.*' => "required|string|max:255",
            'option_4s' => "required|array",
            'option_4s.*' => "required|string|max:255",
        ]);

        for ($i=0; $i < $exam->questions_no; $i++) {
            Question::create([
                'exam_id' => $exam->id,
                'title' => $request->title[$i],
                'option_1' => $request->option_1s[$i],
                'option_2' => $request->option_2s[$i],
                'option_3' => $request->option_3s[$i],
                'option_4' => $request->option_4s[$i],
                'right_answer' => $request->right_anss[$i],
            ]);

        }
        $exam->update(['active' => 1]);
        event(new ExamAddedEvent);
        return redirect('dashboard/exams');
    }

    public function edit(Exam $exam)
    {
        $data['skills'] = skill::select('id','name')->get();
        $data['exam'] = $exam;
        return view('admin.exams.edit',$data);
    }
    public function update(Request $request,Exam $exam ){
        $request->validate([
            'name_en' => "required|string|max:255",
            'name_ar' => "required|string|max:255",
            'desc_en' => "required|string|max:5000",
            'desc_ar' => "required|string|max:5000",
            'image'   => "nullable|image|max:4096",
            'skill_id'  => "required|exists:skills,id",
            'difficulty'=>"required|integer|min:1,max:5",
            'duration_mins'=>"required|integer|min:1",
        ]);
        $imgPath = $exam->image;
        if ($request->hasFile('image')) {
            Storage::delete($imgPath);
            $imgPath = Storage::putFile('exams/',$request->file('image'));
        }
        $exam->update([
            'name' => json_encode([
                'en' => $request->name_en ,
                'ar' => $request->name_ar ,
            ]),
            'description' => json_encode([
                'en' => $request->desc_en ,
                'ar' => $request->desc_ar ,
            ]),
            'image' => $imgPath,
            'skill_id' => $request->skill_id,
            'duration_mins' => $request->duration_mins,
            'difficulty' => $request->difficulty,
        ]);
        session()->flash('msg','row updated succesfully Successfully');
        return redirect('/dashboard/exams');
    }

    public function editQuestions(Exam $exam , Question $questions)
    {
        $data['exam'] = $exam;
        $data['ques'] = $questions;
        return view('admin.exams.questions.edit',$data);
    }

    public function updateQuestions(Exam $exam , Question $questions , Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:500',
            'right_answer' => "required|in:1,2,3,4",
            'option_1' => "required|string|max:255",
            'option_2' => "required|string|max:255",
            'option_3' => "required|string|max:255",
            'option_4' => "required|string|max:255",
        ]);
        $questions->update($data);
        session()->flash('msg','Question Updated successfully');
        return redirect("dashboard/exams/show-questions/$exam->id");
    }

    public function delete(Exam $exam)
    {
        try {
            $path = $exam->image;
            $exam->questions()->delete();
            $exam->delete();
            Storage::delete($path);
            session()->flash('msg', "row deleted successfully");
        } catch (\Throwable $th) {
            session()->flash('error', "can't delete this row");
        }

        return back();
    }

    public function toggle(Exam $exam)
    {
        $exam->update(['active' => !$exam->active]);
        return back();
    }
}
