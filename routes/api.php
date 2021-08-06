<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// user controller routes
Route::post("register", [UserController::class, "register"]);

Route::post("login", [UserController::class, "login"]);

// sanctum auth middleware routes

Route::middleware('auth:api')->group(function() {
    Route::post("logout", [UserController::class, "logout"]);
    Route::get("user", [UserController::class, "user"]);
    Route::resource('users', App\Http\Controllers\API\UserController::class);
});

Route::resource('veiculo-agendamento', App\Http\Controllers\API\VeiculoAgendamentoController::class);
