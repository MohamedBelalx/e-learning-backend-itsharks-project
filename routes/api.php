<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ReviewsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::get('/review', [ReviewsController::class, 'all']);

// Category routes // 

Route::get('/categories', [CategoryController::class, 'all']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

// courses routes // 

Route::get('/course', [CourseController::class, 'all']);
Route::post('/courses', [CourseController::class, 'store']);
Route::get('/courses/{id}', [CourseController::class, 'show']);
Route::put('/courses/{id}', [CourseController::class, 'update']);
Route::delete('/courses/{id}', [CourseController::class, 'destroy']);


// Users Routes // 

Route::get('/user', [UsersController::class, 'all']);
Route::post('/users', [UsersController::class, 'store']);
Route::get('/users/{id}', [UsersController::class, 'show']);
Route::put('/users/{id}', [UsersController::class, 'update']);
Route::delete('/users/{id}', [UsersController::class, 'destroy']);


// Quizes Routes // 

Route::get('/quizzes', [QuizController::class, 'all']);
Route::post('/quizzes', [QuizController::class, 'store']);
Route::get('/quizzes/{id}', [QuizController::class, 'show']);
Route::put('/quizzes/{id}', [QuizController::class, 'update']);
Route::delete('/quizzes/{id}', [QuizController::class, 'destroy']);

