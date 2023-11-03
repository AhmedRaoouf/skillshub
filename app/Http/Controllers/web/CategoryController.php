<?php
namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    public function show($id){
        $data['cat'] = Category::findOrFail($id);
        $data['allCats'] = Category::select('id','name')->active()->get();
        $data['skills'] = $data['cat']->skills()->active()->paginate(6);

        return view('web.categories.show',$data);
    }
}
