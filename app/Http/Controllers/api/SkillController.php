<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\skillResource;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function show($id)
    {
        $Skill = Skill::with('exams')->find($id);
        if ($Skill) {
            return new skillResource($Skill);
        } else {
            return response()->json(['message' => 'Skill not found'], 404);
        }
    }
}
