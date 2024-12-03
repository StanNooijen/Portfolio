<?php

namespace App\Blokken;

use App\models\Popups_details;
use App\models\Popups;

class about_me_block
{
    public function render_public_block($popup_id, $popup_name, $position){
        $popups = Popups::where('type', 'about_me')->first();
        $popup_details = Popups_details::where('type', 'personal')->get();

        $abouts = '';
        foreach ($popup_details as $popup_detail) {
            $values = explode(',', $popup_detail->value);
            $abouts .= '
            <div class="list flex-column">
                <h3 class="p-b-1">'. $popup_detail->label .'</h3>
                <ol class="list w-75 border-top p-t-1 gap-10">';
            foreach ($values as $value) {
                $abouts .= '<li>'. $value .'</li>';
            }
            $abouts .= '</ol>
            </div>';
        }

        return '
        <div class="meerOverMij">
            <div class="row p-l-5 p-t-4 p-r-5 justify-start h-webkit-fill-available w-auto flex-column" style="gap: 30px">
                <div class="col w-100 text-center flex-row space-between">
                    <h1>'. $popups->title .'</h1>
                    <div class="kruis"></div>
                </div>
                <div class="row gap-5 h-100">
                    <div class="col h-100 w-50 space-between">
                        '. $abouts .'
                    </div>
                    <div class="col w-50">
                        <h1>Stan Nooijen</h1>
                        <p class="w-85">'. $popups->text .'</p>
                    </div>
                </div>
                <div class="row space-between details p-b-1 ">
                    <p class="p-l-3">06-23330185</p>
                    <p class="p-r-3">Stan.nooijen@gmail.com</p>
                </div>
            </div>
        </div>
    ';
    }
}
