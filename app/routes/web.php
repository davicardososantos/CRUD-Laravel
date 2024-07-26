<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;

// ADMIN
Route::get('/login', function () {
    return view('admin.login');
})->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('//admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::get('//admin/users', [UserController::class, 'index'])->middleware('auth')->name('admin.users');
Route::get('//admin/{segment?}', [SurveyController::class, 'index'])->middleware('auth')->where('segment', 'home?')->name('admin.home');
Route::get('//admin/reset', function () {
    return view('admin.reset');
})->middleware('auth')->name('admin.reset');
Route::post('/reset', [UserController::class, 'updatePerfil'])->middleware('auth')->name('perfil.post');
Route::post('/users', [UserController::class, 'store'])->middleware('auth')->name('users.store');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->middleware('auth');
Route::post('/survey', [SurveyController::class, 'store'])->middleware('auth')->name('survey.store');
// APP

Route::get('/', function () {
    return view('verify');
})->name('verify');

Route::get('/home', function () {
    if (!session('authenticated')) {
        return redirect()->route('verify')->with('error', 'Você precisa se autenticar para acessar.');
    }
    return view('home');
})->name('home');

Route::post('/verify', function (Request $request) {
    $digit1 = $request->input('digit1');
    $digit2 = $request->input('digit2');
    $digit3 = $request->input('digit3');
    $digit4 = $request->input('digit4');

    $password = $digit1 . $digit2 . $digit3 . $digit4;

    if ($password === '2024') {
        session(['authenticated' => true]);
        return redirect()->route('home');
    }
    return redirect()->route('verify')->with('error', 'Senha incorreta. Tente novamente.');
});

Route::get('/logout', function () {
    session()->forget('authenticated');
    return redirect()->route('verify')->with('success', 'Você foi desconectado com sucesso.');
});

Route::post('/survey', [SurveyController::class, 'store']);
