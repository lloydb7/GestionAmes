<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StarController;
use App\Http\Controllers\AmeController;
use App\Http\Controllers\FamilleImpactController;
use App\Http\Controllers\SuiviController;
use App\Http\Controllers\EntretienController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RapportController;


Route::get('/', function () {
    return redirect('/login');
});

// Routes d'authentification (Laravel Breeze)
require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
   
    /*
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/rapport/tableau', [DashboardController::class, 'exportTableau'])->name('rapport.tableau');
    Route::get('/rapport/export', [RapportController::class, 'exportCSV'])->name('rapport.exportCSV');

    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');

    //Route::resource('users', UserController::class);
    Route::resource('users', UserController::class);
    Route::resource('stars', StarController::class);
    Route::resource('ames', AmeController::class);
    Route::resource('familles', FamilleImpactController::class);

    

    Route::resource('suivis', SuiviController::class);
    Route::resource('suivis', SuiviController::class)->except(['edit', 'update', 'destroy']);
    Route::get('suivis/historique/{ame_id}', [SuiviController::class, 'historique'])->name('suivis.historique');
    Route::get('suivis/create/{ame_id}', [SuiviController::class, 'create'])->name('suivis.create');
    Route::post('suivis/store/{ame_id}', [SuiviController::class, 'store'])->name('suivis.store');

    Route::get('liste-entretiens', [EntretienController::class, 'liste_entretiens'])->name('entretiens.liste_entretiens');
    Route::get('entretiens/{ame_id}', [EntretienController::class, 'index'])->name('entretiens.index');
    Route::get('entretiens/show/{id}', [EntretienController::class, 'show'])->name('entretiens.show');
    Route::get('entretiens/create/{ame_id}', [EntretienController::class, 'create'])->name('entretiens.create');
    Route::post('entretiens/store/{ame_id}', [EntretienController::class, 'store'])->name('entretiens.store');
    Route::get('entretiens/edit/{id}', [EntretienController::class, 'edit'])->name('entretiens.edit');
    Route::put('entretiens/update/{id}', [EntretienController::class, 'update'])->name('entretiens.update');
    Route::delete('entretiens/delete/{id}', [EntretienController::class, 'destroy'])->name('entretiens.destroy');

});
