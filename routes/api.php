<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\ExamController;
use App\Http\Controllers\api\SkillController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/register',[AuthController::class,'register']);

Route::get('categories',[CategoryController::class,'index']);
Route::get('categories/show/{id}',[CategoryController::class,'show']);
Route::get('skills/show/{id}',[SkillController::class,'show']);
Route::get('exams/show/{id}',[ExamController::class,'show']);

Route::middleware('auth:sanctum')->group(function(){

    Route::get('exams/show-questions/{id}',[ExamController::class,'showQuestions']);
    Route::post('exams/start/{id}',[ExamController::class,'start']);
    Route::post('exams/submit/{id}',[ExamController::class,'submit']);
});
