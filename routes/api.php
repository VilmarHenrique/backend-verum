<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PokemonController;

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

Route::post('/login',            [AuthController::class, 'login']) ->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/pokemons',          [PokemonController::class, 'fetchPokemons'])       ->name('pokemons');
    Route::get('/imported-pokemons', [PokemonController::class, 'listImportedPokemons'])->name('listImportedPokemons');
    Route::post('/import-pokemon',   [PokemonController::class, 'savePokemon'])->name('savePokemon');
});



