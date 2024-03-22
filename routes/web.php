<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\TestListController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::resource('listas', TestListController::class);
    Route::resource('cards', CardController::class);
    Route::get('listas/{list}/cards/criar', [CardController::class, 'create'])->name('cards.criar');
    Route::get('listas/cards/{card}/editar', [CardController::class, 'edit'])->name('cards.editar');
    Route::get('listas/cards/{card}/deletar', [CardController::class, 'destroy'])->name('cards.deletar');
});
