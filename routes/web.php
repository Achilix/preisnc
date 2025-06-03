<?php

use App\Http\Controllers\PreRegisterController;
use App\Http\Controllers\Etape1Controller;
use App\Http\Controllers\Etape2Controller;
use App\Http\Controllers\Etape3Controller;
use App\Http\Controllers\Etape4Controller;
use App\Http\Controllers\Etape5Controller;
use App\Http\Controllers\Etape6Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'check.etape.step'])->group(function () {
    // Etape 1: Next step after registration
    Route::get('/etape1', [Etape1Controller::class, 'showEtape1'])->name('Etape1');
    Route::post('/etape1', [Etape1Controller::class, 'handleForm'])->name('Etape1.submit');

    // Etape 2: Next step after Etape 1
    Route::get('/etape2', [Etape2Controller::class, 'showEtape2'])->name('Etape2');
    Route::post('/etape2', [Etape2Controller::class, 'submitEtape2'])->name('Etape2.submit');

    // Etape 3: Next step after Etape 2
    Route::get('/etape3', [Etape3Controller::class, 'show'])->name('Etape3');
    Route::post('/etape3', [Etape3Controller::class, 'submit'])->name('Etape3.submit');

    // Etape 4: Next step after Etape 3
    Route::get('/etape4', [Etape4Controller::class, 'show'])->name('Etape4');
    Route::post('/etape4', [Etape4Controller::class, 'submit'])->name('Etape4.submit');

    // Etape 5: Next step after Etape 4
    Route::get('/etape5', [Etape5Controller::class, 'show'])->name('Etape5');
    Route::post('/etape5', [Etape5Controller::class, 'submit'])->name('Etape5.submit');

    // Etape 6: Final step after Etape 5
    Route::get('/etape6', [Etape6Controller::class, 'showEtape6'])->name('Etape6');
    Route::post('/etape6', [Etape5Controller::class, 'submitEtape6'])->name('Etape6.submit');

    Route::post('/recu/download', [Etape6Controller::class, 'download'])->name('recu.download');

});

Route::get('/preregister', [PreRegisterController::class, 'showForm'])->name('pre-register.form');
Route::post('/preregister', [PreRegisterController::class, 'handleForm'])->name('pre-register.submit');

Route::get('/guide', function () {
    return view('Guide');
})->name('guide');

Route::get('/faq', function () {
    return view('FAQ');
})->name('faq');

Route::get('/mentions-legales', function () {
    return view('mentionslegales');
})->name('mentionslegales');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

require __DIR__.'/auth.php';

