<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CandidateController as AdminCandidateController;
use App\Http\Controllers\Admin\VoteController as AdminVoteController;
use App\Http\Controllers\Admin\SettingController;

Route::get('/', function () {
    return view('welcome');
})->name('homepage');


Auth::routes(); // Remove one of the Auth::routes() calls

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/vote', [VoteController::class, 'store'])->name('vote.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('Dashboard');;
    Route::prefix('students')->group(function () {
        Route::get('/', [StudentsController::class, 'index'])->name('admin.students.index');
        Route::get('/create', [StudentsController::class, 'create'])->name('admin.students.create');
        Route::post('/', [StudentsController::class, 'store'])->name('admin.students.store');
        Route::get('/{user}/edit', [StudentsController::class, 'edit'])->name('admin.students.edit');
        Route::put('/{user}', [StudentsController::class, 'update'])->name('admin.students.update');
        Route::delete('/{user}', [StudentsController::class, 'destroy'])->name('admin.students.destroy');
    });
    Route::prefix('candidates')->group(function () {
        Route::get('/', [CandidateController::class, 'index'])->name('admin.candidates.index');
        Route::get('/create', [CandidateController::class, 'create'])->name('admin.candidates.create');
        Route::get('/{candidate}', [CandidateController::class, 'show'])->name('admin.candidates.show');
        Route::post('/', [CandidateController::class, 'store'])->name('admin.candidates.store');
        Route::get('/{candidate}/edit', [CandidateController::class, 'edit'])->name('admin.candidates.edit');
        Route::put('/{candidate}', [CandidateController::class, 'update'])->name('admin.candidates.update');
        Route::delete('/{candidate}', [CandidateController::class, 'destroy'])->name('admin.candidates.destroy');
    });

});

Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::resource('users', AdminUserController::class)->names('admin.users');
        Route::resource('candidates', CandidateController::class)->names('admin.candidates');
        Route::get('/votes', [AdminVoteController::class, 'index'])->name('admin.votes.index');
        Route::get('/votes/export', [AdminVoteController::class, 'export'])->name('admin.votes.export');
    });
});

Route::prefix('profile')->middleware(['auth'])->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('profile.index');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('profile.update');
});




