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
    Route::get('/popup/{popup_id}/{title}', [Controller::class, 'popup'])->name('popup');
    Route::get('/skill/{skill_id}', [Controller::class, 'skill'])->name('skill');
    Route::get('/entrie/{entrie_id}', [Controller::class, 'entrie'])->name('entrie');

    Route::post('/updatenBlok', [ApiController::class, 'updatenBlok']);
    Route::post('/setActive/{popup_id}}', [ApiController::class, 'setActive'])->name('setActive');
    Route::post('/skillPopup', [ApiController::class, 'skillPopup'])->name('skillPopup');
    Route::post('/entrieSave', [ApiController::class, 'entrieSave'])->name('entrieSave');
});

//Route::get('/switch-language/{locale}', function ($locale) {
//    if (in_array($locale, ['en', 'nl'])) { // List all supported languages
//        Session::put('locale', $locale);
//    }
//    return redirect()->back();
//})->name('lang.switch');

require __DIR__ . '/auth.php';
