<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SkillController extends Controller
{
    public function index()
    {
        $data['skills'] = Skill::orderBy('id', 'Desc')->paginate(10);
        $data['cats'] = Category::select('id','name')->get();
        return view('admin.skills.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => "required|string|max:50",
            'name_ar' => "required|string|max:50",
            'image'   => "required|image|max:4096",
            'cat_id'  => "required|exists:categories,id",
        ]);

        $imgPath = Storage::putFile('skills',$request->file('image'));
        Skill::create([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'category_id' => $request->cat_id,
            'image' => $imgPath,
        ]);
        session()->flash('msg', 'row added successfully');
        return back();
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => "required|exists:skills,id",
            'name_en' => "required|string|max:50",
            'name_ar' => "required|string|max:50",
            'cat_id'  => "required|exists:categories,id",
            'image'   => "nullable|image|max:4096",
        ]);
        $skill = Skill::findOrFail($request->id);
        $imgPath = $skill->image;
        if ($request->hasFile('image')) {
            Storage::delete($imgPath);
            $imgPath = Storage::putFile('skills',$request->file('image'));
        }
        $skill->update([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'category_id' => $request->cat_id,
            'image' => $imgPath,
        ]);
        session()->flash('msg', 'row updated successfully');
        return back();
    }
    public function delete(Skill $skill)
    {
        try {
            $path = $skill->image;
            $skill->delete();
            Storage::delete($path);
            session()->flash('msg', "row deleted successfully");
        } catch (\Throwable $th) {
            session()->flash('error', "can't delete this row");
        }

        return back();
    }

    public function toggle(Skill $skill)
    {
        $skill->update(['active' => ! $skill->active]);
        return back();
    }


}
