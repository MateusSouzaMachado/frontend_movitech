<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MecanicaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\MovimentacaoEstoqueController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarrinhoController;



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produtos/{produto}', [ProdutoController::class, 'show'])->name('produtos.show');
Route::post('/carrinho/{produto}', [CarrinhoController::class, 'store'])->name('carrinho.store');
Route::get('/carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');
Route::delete('/carrinho/{produto}', [CarrinhoController::class, 'destroy'])->name('carrinho.destroy');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



  

