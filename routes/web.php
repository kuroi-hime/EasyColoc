<?php

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/depenses', function () {
    return view('depenses');
})->middleware(['auth', 'verified'])->name('depenses');

Route::post('/add-depense', [DepenseController::class, 'store'])->middleware(['auth', 'verified'])->name('depense.add');

Route::get('/colocations', [ColocationController::class, 'index'])->middleware(['auth', 'verified'])->name('colocations');

Route::post('/add-colocation', [ColocationController::class, 'store'])->middleware(['auth', 'verified'])->name('colocation.add');

Route::patch('/colocations/{colocation}/cancel', [ColocationController::class, 'cancel'])->middleware(['auth', 'verified'])->name('colocations.cancel');

Route::delete('/colocations/{colocation}/delete', [ColocationController::class, 'destroy'])->middleware(['auth', 'verified'])->name('colocations.destroy');

Route::post('')->middleware(['auth', 'verified'])->name('colocations.leave');

Route::get('/accueil', [AccueilController::class, 'index'])->middleware(['auth', 'verified'])->name('accueil');

Route::post('/add-invitation', [InvitationController::class, 'store'])->middleware(['auth', 'verified'])->name('invite.add');

Route::get('/invitations/{token}', [InvitationController::class, 'index'])->middleware(['auth', 'verified'])->name('invite.index');

Route::post('/invitations/{token}/reject-invitation', [InvitationController::class, 'reject'])->middleware(['auth', 'verified'])->name('invitations.reject');

Route::post('/invitations/{token}/accept-invitation', [InvitationController::class, 'accept'])->middleware(['auth', 'verified'])->name('invitations.accept');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
