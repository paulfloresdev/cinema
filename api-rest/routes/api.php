<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::post('auth/signup', [AuthController::class, 'create']);
Route::post('auth/login', [AuthController::class, 'login']);
Route::post('movies/test', [MovieController::class, 'upImage']);
Route::post('movies', [MovieController::class, 'store']);

Route::get('/images/{filename}', function ($filename) {
    $path = Storage::url('public/images/' . $filename);
    return response()->file(storage_path('app/' . $path));
});

Route::get('/videos/{filename}', function ($filename) {
    $path = Storage::url('public/videos/' . $filename);
    return response()->file(storage_path('app/' . $path));
});

Route::middleware(['auth:sanctum'])->group(function () {

    /*-----AUTH------*/
    //  logout
    Route::post('auth/logout', [AuthController::class, 'logout']);
    //  CheckTocken
    Route::post('auth/check-token', [AuthController::class, 'checkToken']);


});