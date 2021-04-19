<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\SaleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// route group for applying middleware to several endpoints
Route::middleware('auth')->group(function() {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);

    // liking, renting or buying movies requires log-in
    Route::post('/rent/{movie}', [RentalController::class, 'store']);
    Route::put('/return/{rental}', [RentalController::class, 'update']);
    Route::post('/buy/{movie}', [SaleController::class, 'store']);
    
    // pending to implement likes feature
    Route::post('/like/{movie}', [LikeController::class, 'update']);
});

// only admin users can create, update or delete movies
Route::middleware(['auth', 'admin'])->group(function() {
    Route::post('/movies', [MovieController::class, 'store']);
    Route::put('/movies/{movie}', [MovieController::class, 'update']);
    Route::delete('/movies/{movie}', [MovieController::class, 'destroy']);
    
    Route::get('/rentals', [RentalController::class, 'index']);
    Route::get('/rentals/pending', [RentalController::class, 'getPendingRentals']);
    Route::get('/rentals/movie/{movie}', [RentalController::class, 'getRentalsByMovie']);
    Route::get('/rentals/user/{user}', [RentalController::class, 'getRentalsByUser']);
    
    Route::get('/sales', [SaleController::class, 'index']);
    
    // pending to implement filtered sales listings
    Route::get('/sales/movie/{movie}', [SalesController::class, 'getSalesByMovie']);
    Route::get('/sales/user/{user}', [SalesController::class, 'getSalesByUser']);

    // pending to implement likes feature
    Route::get('/likes', [LikeController::class, 'index']);
    Route::get('/likes/movie/{movie}', [LikeController::class, 'getLikesByMovie']);
    Route::get('/likes/user/{user}', [LikeController::class, 'getLikesByUser']);
});

// login and register can be done without being logged-in
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// anyone (even guests) can browse the movie list or details
Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movies/{movie}', [MovieController::class, 'show']);
