<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Redirect;

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes (Protected)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/players', [AdminController::class, 'players'])->name('admin.players');
    Route::get('/player-stats', [AdminController::class, 'playerStats'])->name('admin.player-stats');
    Route::get('/tournament-summary', [AdminController::class, 'tournamentSummary'])->name('admin.tournament-summary');
});

// User Routes (Protected)
Route::middleware('auth')->group(function () {
    Route::get('/players', [UserController::class, 'players'])->name('user.players');
    Route::get('/team', [UserController::class, 'team'])->name('user.team');
    Route::post('/team/remove', [UserController::class, 'removePlayer'])->name('user.remove-player');
    Route::get('/budget', [UserController::class, 'budget'])->name('user.budget');
    Route::get('/leaderboard', [UserController::class, 'leaderboard'])->name('user.leaderboard');
    Route::get('/select-team', [UserController::class, 'selectTeam'])->name('user.select-team');
    Route::post('/save-team', [UserController::class, 'saveTeam'])->name('user.save-team');
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
});