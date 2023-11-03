<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\admin\ExamController as AdminExamController;
use App\Http\Controllers\admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\MessageController;
use App\Http\Controllers\admin\SkillController as AdminSkillController;
use App\Http\Controllers\admin\StudentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\web\CategoryController;
use App\Http\Controllers\web\ExamController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\ProfileController;
use App\Http\Controllers\web\SkillController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Translation in website
Route::middleware("lang")->group(function () {
    Route::get("/", [HomeController::class, "index"]);
    Route::get("/categories/show/{id}", [CategoryController::class, "show"]);
    Route::get("/skills/show/{id}", [SkillController::class, "show"]);
    Route::get("/exams/show/{id}", [ExamController::class, "show"]);
    Route::get("/exams/questions/{id}", [ExamController::class, "questions"])->middleware(["auth", "verified", "student"]);
    Route::get("/contact", [ContactController::class, "index"]);
    Route::get("/profile", [ProfileController::class, "index"])->middleware(["auth", "verified", "student"]);
});

Route::post("/exams/start/{id}", [ExamController::class, "start"])->middleware(["auth", "verified", "student", "can-enter-exam"]);
Route::post("/exams/submit/{id}", [ExamController::class, "submit"])->middleware(["auth", "verified", "student"]);

Route::post("/contact/message/send", [ContactController::class, "send"]);
Route::get("/lang/set/{lang}", [LangController::class, "set"]);

Route::prefix("/dashboard")->middleware(["auth", "verified", "can-enter-dashboard"])->group(function () {
    Route::get("/", [AdminHomeController::class, "index"]);
    //Categories
    Route::get("/categories", [AdminCategoryController::class, "index"]);
    Route::post("/categories/store", [AdminCategoryController::class, "store"]);
    Route::get("/categories/delete/{cat}", [AdminCategoryController::class, "delete"]);
    Route::get("/categories/toggle/{cat}", [AdminCategoryController::class, "toggle"]);
    Route::post("/categories/update", [AdminCategoryController::class, "update"]);

    //Skills
    Route::get("/skills", [AdminSkillController::class, "index"]);
    Route::post("/skills/store", [AdminSkillController::class, "store"]);
    Route::get("/skills/delete/{skill}", [AdminSkillController::class, "delete"]);
    Route::get("/skills/toggle/{skill}", [AdminSkillController::class, "toggle"]);
    Route::post("/skills/update", [AdminSkillController::class, "update"]);

    //Exams
    Route::get("/exams", [AdminExamController::class, "index"]);
    Route::get("/exams/show/{exam}", [AdminExamController::class, "show"]);
    Route::get("/exams/show-questions/{exam}", [AdminExamController::class, "showQuestions"]);

    Route::get("/exams/create", [AdminExamController::class, "create"]);
    Route::post("/exams/store", [AdminExamController::class, "store"]);
    Route::get("/exams/create-questions/{exam}", [AdminExamController::class, "createQuestions"]);
    Route::post("/exams/store-questions/{exam}", [AdminExamController::class, "storeQuestions"]);

    Route::get("/exams/edit/{exam}", [AdminExamController::class, "edit"]);
    Route::post("/exams/update/{exam}", [AdminExamController::class, "update"]);
    Route::get("/exams/edit-questions/{exam}/{questions}", [AdminExamController::class, "editQuestions"]);
    Route::post("/exams/update-questions/{exam}/{questions}", [AdminExamController::class, "updateQuestions"]);

    Route::get("/exams/delete/{exam}", [AdminExamController::class, "delete"]);
    Route::get("/exams/toggle/{exam}", [AdminExamController::class, "toggle"]);

    //Students
    Route::get("/students", [StudentController::class, "index"]);
    Route::get("/students/show-scores/{id}", [StudentController::class, "showScores"]);
    Route::get("/students/open-exam/{studentId}/{examId}", [StudentController::class, "openExam"]);
    Route::get("/students/close-exam/{studentId}/{examId}", [StudentController::class, "closeExam"]);

    //Admins
    Route::middleware('superadmin')->group(function() {
        Route::get("/admins", [AdminController::class, "index"]);
        Route::get("/admins/create", [AdminController::class, "create"]);
        Route::post("/admins/store", [AdminController::class, "store"]);
        Route::get("/admins/delete/{id}", [AdminController::class, "delete"]);
        Route::get("/admins/promote/{id}", [AdminController::class, "promote"]);
        Route::get("/admins/demote/{id}", [AdminController::class, "demote"]);
    });

    //Messages
    Route::get('/messages', [MessageController::class, 'index']);
    Route::get('/messages/show/{msg}', [MessageController::class, 'show']);
    Route::get('/messages/response/{msg}', [MessageController::class, 'response']);

});
