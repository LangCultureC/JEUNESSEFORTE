<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JeunesseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RendezvousController;
use App\Http\Controllers\SalonController;

Route::get('/', function () { return view('index'); });

Route::get('/connexion', [AuthController::class, 'showLogin'])->name('login');
Route::post('/connexion', [AuthController::class, 'login']);
Route::get('/inscription', [AuthController::class, 'showRegister']);
Route::post('/inscription', [AuthController::class, 'register']);
Route::get('/deconnexion', [AuthController::class, 'logout']);

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/valider/{id}', [AdminController::class, 'valider']);
    Route::post('/refuser/{id}', [AdminController::class, 'refuser']);
    Route::post('/role/{id}', [AdminController::class, 'changerRole']);
    Route::delete('/supprimer/{id}', [AdminController::class, 'supprimer']);
});

Route::middleware(['auth', 'pro'])->get('/dashboard-pro', function () {
    return view('dashboard-pro');
})->name('dashboard.pro');

// LA ROUTE EST ICI MAINTENANT (En dehors du groupe API)
// Route pour afficher la page de messagerie partagée (Pros et Jeunes)
Route::get('/messagerie', function () {
    return view('messagerie');
})->middleware('auth');


// DEBUT DU GROUPE API
Route::prefix('api')->group(function () {
    Route::get('/statut-connexion', [JeunesseController::class, 'statutConnexion']);
    Route::get('/commentaires', [JeunesseController::class, 'getConfessions']);

    Route::middleware('auth')->group(function () {
        Route::post('/confessions', [JeunesseController::class, 'storeConfession']);
        Route::post('/commentaires/{id}/repondre', [JeunesseController::class, 'storeReponse']);
        Route::post('/rendezvous/demander', [RendezvousController::class, 'demander']);
        Route::get('/rendezvous/mes-rdv', [RendezvousController::class, 'mesRdv']);
        Route::get('/salons/mes-salons', [SalonController::class, 'mesSalons']);
        Route::get('/salons/{id}/messages', [SalonController::class, 'messages']);
        Route::post('/salons/{id}/envoyer', [SalonController::class, 'envoyer']);
    });

    Route::middleware(['auth', 'pro'])->group(function () {
        Route::get('/rendezvous/attente', [RendezvousController::class, 'enAttente']);
        Route::post('/rendezvous/{id}/traiter', [RendezvousController::class, 'traiter']);
        Route::post('/salons/creer', [SalonController::class, 'creer']);
    });
});