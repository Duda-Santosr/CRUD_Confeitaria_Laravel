<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HistoricoController;
use App\Http\Controllers\MovimentacaoController;
use App\Http\Controllers\SobremesaController;
use Illuminate\Support\Facades\Route;

// Rota principal redireciona para sobremesas
Route::get('/', function () {
    return redirect()->route('sobremesas.index');
});

// Rotas de autenticação
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rotas protegidas
Route::middleware('auth:usuarios')->group(function () {

    // Sobremesas
    Route::get('/sobremesas', [SobremesaController::class, 'index'])->name('sobremesas.index');
    Route::post('/sobremesas', [SobremesaController::class, 'store'])->name('sobremesas.store');
    Route::get('/sobremesas/{sobremesa}/edit', [SobremesaController::class, 'edit'])->name('sobremesas.edit');
    Route::put('/sobremesas/{sobremesa}', [SobremesaController::class, 'update'])->name('sobremesas.update');
    Route::delete('/sobremesas/{sobremesa}', [SobremesaController::class, 'destroy'])->name('sobremesas.destroy');

    // Movimentações
    Route::get('/movimentacoes', [MovimentacaoController::class, 'index'])->name('movimentacoes.index');
    Route::post('/movimentacoes', [MovimentacaoController::class, 'store'])->name('movimentacoes.store');

    // Histórico
    Route::get('/historico', [HistoricoController::class, 'index'])->name('historico.index');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
