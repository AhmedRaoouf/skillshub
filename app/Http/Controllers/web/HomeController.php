<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Exam;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['exams'] = Exam::select('id','name','description','image')->get();
        // $data['cats'] = $data['exams']->skill->category->name;
        return view('web.home.index',$data);
    }
}
