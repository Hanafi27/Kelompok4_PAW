<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\Admin\AuthController; // Import AuthController lagi
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// API Login untuk mendapatkan token JWT
Route::post('/login', [AuthController::class, 'apiLogin']);

// Grup rute API yang dilindungi JWT
Route::middleware('auth:api')->group(function () {
    // API untuk mendapatkan daftar kandidat (dilindungi dengan JWT)
    Route::get('/candidates', [CandidateController::class, 'apiIndex']);
    
    // API Logout untuk membatalkan token JWT
    Route::post('/logout', [AuthController::class, 'apiLogout']);

    // API untuk memberikan suara
    Route::post('/vote', [UserController::class, 'apiVote']);

    // API untuk mendapatkan detail pengguna yang terautentikasi
    Route::get('/me', [AuthController::class, 'apiMe']);

    // API untuk mendapatkan hasil pemilihan (jumlah suara per kandidat)
    Route::get('/votes/results', [CandidateController::class, 'apiResults']);
});
