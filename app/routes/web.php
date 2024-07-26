<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;
use Illuminate\Http\Request;

// ADMIN
Route::get('//admin/home', function () {
    return view('admin.home');
})->name('admin');

Route::get('//admin/users', function () {
    return view('admin.home');
})->name('admin');
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
