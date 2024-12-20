<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Entries;
use App\Models\Popups;

class AppComposer
{
    public function compose(View $view)
    {
        $popups = Popups::all();
        $entries = Entries::all();

        $view->with(['entries' => $entries, 'popups' => $popups]);
    }
}
