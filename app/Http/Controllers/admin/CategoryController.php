<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        // $data['cats'] = Category::get();
        $data['cats'] = Category::orderBy('id', 'Desc')->paginate(10);
        return view('admin.categories.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => "required|string|max:50",
            'name_ar' => "required|string|max:50",
        ]);

        Category::create([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
        ]);
        session()->flash('msg', 'row added successfully');
        return back();
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => "required|exists:categories,id",
            'name_en' => "required|string|max:50",
            'name_ar' => "required|string|max:50",
        ]);

        Category::findOrFail($request->id)->update([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
        ]);
        session()->flash('msg', 'row updated successfully');
        return back();
    }
    public function delete(Category $cat)
    {
        
        $cat->delete();
        try {
            $cat->delete();
            session()->flash('msg', "row deleted successfully");
        } catch (\Throwable $th) {
            session()->flash('error', "can't delete this row");
        }



        return back();
    }

    public function toggle(Category $cat)
    {
        $cat->update(['active' => ! $cat->active]);
        return back();
    }
}
