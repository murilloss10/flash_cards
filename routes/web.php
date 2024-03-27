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
        $user = Auth::user();
        return view('dashboard', compact('user'));
    })->name('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::resource('listas', TestListController::class);
    Route::get('listas/{lista}/deletar', [TestListController::class, 'destroy'])->name('listas.deletar');
    Route::get('listas/{lista}/cards', [TestListController::class, 'findCards'])->name('listas.cards');
    Route::post('listas/teste/finalizar', [TestListController::class, 'saveTestPerformed'])->name('listas.teste.finalizar');

    Route::resource('cards', CardController::class);
    Route::get('listas/{list}/cards/criar', [CardController::class, 'create'])->name('cards.criar');
    Route::get('listas/cards/{card}/editar', [CardController::class, 'edit'])->name('cards.editar');
    Route::get('listas/cards/{card}/deletar', [CardController::class, 'destroy'])->name('cards.deletar');
});
