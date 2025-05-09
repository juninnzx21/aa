<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/games/pong', function () {
        return view('dashboard');
    })->name('dashboard'); // <- ESSA É A ROTA USADA NO REDIRECIONAMENTO
});
Route::get('/dashboard', function () {
    return redirect('/');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Jogo Pong
    Route::get('/pong', [GameController::class, 'pong'])->name('pong');

    // Atualizar saldo
    Route::post('/atualizar-saldo', [GameController::class, 'atualizarSaldo'])->name('atualizar-saldo');

    // Histórico de jogos
    Route::get('/historico', [GameController::class, 'historico'])->name('historico');
});
