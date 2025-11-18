<?php

use App\Http\Controllers\FundController;
use App\Http\Controllers\GraphController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/instructions', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

# Investor
Route::get('/investors', [InvestorController::class, 'index'])->name('investors.index');
Route::get('/investors/create', [InvestorController::class, 'create'])->name('investors.create');
Route::post('/investors', [InvestorController::class, 'store'])->name('investors.store');
Route::get('/investors/{id}/edit', [InvestorController::class, 'edit'])->name('investors.edit');
Route::put('/investors/{id}', [InvestorController::class, 'update'])->name('investors.update');

# Funds
Route::get('/funds', [FundController::class, 'index'])->name('funds.index');
Route::get('/funds/create', [FundController::class, 'create'])->name('funds.create');
Route::post('/funds', [FundController::class, 'store'])->name('funds.store');
Route::get('/funds/{fund}/edit', [FundController::class, 'edit'])->name('funds.edit');
Route::put('/funds/{fund}', [FundController::class, 'update'])->name('funds.update');

Route::get("investments", [InvestmentController::class, 'index'])->name('investments.index');

Route::get("graph", [GraphController::class, 'index'])->name('graph.index');

Route::get('/exam', function () {
    return view('exam.index');
})->name('exam.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
