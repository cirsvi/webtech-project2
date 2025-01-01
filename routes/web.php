<?php

use App\Http\Controllers\PaintingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'index']);

// Artist routes:
Route::get('/artists', [ArtistController::class, 'list']);
Route::get('/artists/create', [ArtistController::class, 'create']);
Route::post('/artists/put', [ArtistController::class, 'put']);
Route::get('/artists/update/{artist}', [ArtistController::class, 'update']);
Route::post('/artists/patch/{artist}', [ArtistController::class, 'patch']);
Route::post('/artists/delete/{artist}', [ArtistController::class, 'delete']);

// Auth routes:
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);

//Book routes:
Route::get('/paintings', [PaintingController::class, 'list']);
Route::get('/paintings/create', [PaintingController::class, 'create']);
Route::post('/paintings/put', [PaintingController::class, 'put']);
Route::get('/paintings/update/{painting}', [PaintingController::class, 'update']);
Route::post('/paintings/patch/{painting}', [PaintingController::class, 'patch']);
Route::post('/paintings/delete/{painting}', [PaintingController::class, 'delete']);
