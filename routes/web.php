<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;


// Route::get('/', [MainController::class, 'index']);
Route::get('/main/{value}', [MainController::class, 'index']);
Route::get('/page2/{value}', [MainController::class, 'page2']);
