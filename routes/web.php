<?php

use App\Http\Controllers\PaintingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\StyleController;
use App\Http\Controllers\DataController;

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

//Painting routes:
Route::get('/paintings', [PaintingController::class, 'list']);
Route::get('/paintings/create', [PaintingController::class, 'create']);
Route::post('/paintings/put', [PaintingController::class, 'put']);
Route::get('/paintings/update/{painting}', [PaintingController::class, 'update']);
Route::post('/paintings/patch/{painting}', [PaintingController::class, 'patch']);
Route::post('/paintings/delete/{painting}', [PaintingController::class, 'delete']);

//Location routes:
Route::get('/locations', [LocationController::class, 'list']);
Route::get('/locations/create', [LocationController::class, 'create']);
Route::post('/locations/put', [LocationController::class, 'put']);
Route::get('/locations/update/{location}', [LocationController::class, 'update']);
Route::post('/locations/patch/{location}', [LocationController::class, 'patch']);
Route::post('/locations/delete/{location}', [LocationController::class, 'delete']);

//Style routes:
Route::get('/styles', [StyleController::class, 'list']);
Route::get('/styles/create', [StyleController::class, 'create']);
Route::post('/styles/put', [StyleController::class, 'put']);
Route::get('/styles/update/{style}', [StyleController::class, 'update']);
Route::post('/styles/patch/{style}', [StyleController::class, 'patch']);
Route::post('/styles/delete/{style}', [StyleController::class, 'delete']);

// Data/API
Route::get('/data/get-top-paintings', [DataController::class, 'getTopPaintings']);
Route::get('/data/get-painting/{painting}', [DataController::class, 'getPainting']);
Route::get('/data/get-related-paintings/{painting}', [DataController::class, 'getRelatedPaintings']);
