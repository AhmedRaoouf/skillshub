<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CatResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return CatResource::collection(Category::get());
    }

    public function show($id)
    {
        $cat = Category::with('skills')->find($id);
        if ($cat) {
            return new CatResource($cat);
        } else {
            return response()->json(['message' => 'Category not found'], 404);
        }
    }

}
