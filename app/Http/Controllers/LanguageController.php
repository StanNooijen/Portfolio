<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switchLang($locale): RedirectResponse
    {
        if (array_key_exists($locale, config('app.locales'))) {
            App::setLocale($locale);
            Session::put('locale', $locale);

            dd(Session::get('locale'));
        }
        return Redirect::back();
    }
}
