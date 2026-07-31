<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get("/login", [AuthController::class, "login"]);
Route::post("/login", [AuthController::class, "loginSubmit"]);
Route::get("/logout", [AuthController::class, "logout"]);

