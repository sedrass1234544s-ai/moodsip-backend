<?php

use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\AnswerController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CoffeeController;
use App\Http\Controllers\Api\CoffeePalaceController;
use App\Http\Controllers\Api\MoodController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Api\SuggestionController;
use App\Http\Controllers\Api\UserHistoryController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/user', [AuthController::class, 'updateUser']);

    // Quiz routes
    Route::get('/random-questions', [QuizController::class, 'getQuestions']);
    Route::post('/submit-answers', [QuizController::class, 'submitAnswers']);

    // User history routes
    Route::get('/history', [UserHistoryController::class, 'history']);

    // Questions routes
    Route::apiResource('questions', QuestionController::class);

    // Answers routes
    Route::apiResource('answers', AnswerController::class);

    // Moods routes
    Route::apiResource('moods', MoodController::class);

    // Suggestions routes
    Route::apiResource('suggestions', SuggestionController::class);

    // Coffee routes
    Route::apiResource('coffees', CoffeeController::class);

    // Coffee Palaces routes
    Route::apiResource('coffee-palaces', CoffeePalaceController::class);

    // Activities routes
    Route::apiResource('activities', ActivityController::class);

    // Books routes
    Route::apiResource('books', BookController::class);
});
