<?php


use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [Controller::class, 'getData'])->name('getData');

Route::get('/dashboard', [Controller::class,'getDataAdmin'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/block/{block}', [Controller::class, 'block'])->name('block');
    Route::post('/updatenBlok', [ApiController::class, 'updatenBlok']);
    Route::get('/skill/{skill_id}', [Controller::class, 'skill'])->name('skill');
});

//Route::get('/switch-language/{locale}', function ($locale) {
//    if (in_array($locale, ['en', 'nl'])) { // List all supported languages
//        Session::put('locale', $locale);
//    }
//    return redirect()->back();
//})->name('lang.switch');

require __DIR__ . '/auth.php';
