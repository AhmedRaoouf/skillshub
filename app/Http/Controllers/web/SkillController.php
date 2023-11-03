<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function show($id)
    {
        $data['skill'] = Skill::findOrFail($id);
        
        return view('web.skills.show', $data);
    }
}
