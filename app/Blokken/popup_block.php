<?php

namespace App\Blokken;

use App\Models\Popups;
use App\Models\Popups_details;

class popup_block
{
    public function render_public_popup($popup_id, $popup_name, $position){
        $popups = Popups::where('type', $popup_name)->first();
        $popup_details = Popups_details::where('popup_id', $popup_id)->get();
        $html = '';

        if ($popup_name == 'about_me') {
            $abouts = '';
            foreach ($popup_details as $popup_detail) {
                $int = 1;
                $values = explode(',', $popup_detail->value);
                $abouts .= '
            <div class="list gap-1 flex-column">
                <h3>' . $popup_detail->label . '</h3>
                <ol class="list w-75 gap-1">';
                foreach ($values as $value) {
                    $number = $int . '. ';

                    $abouts .= '<ul>' . $number . $value . '</ul>';
                    $int++;
                }
                $abouts .= '</ol>
            </div>';
            }

            $html ='
            <div class="popup" id="'. $popup_name .'_popup">
                <div class="container">
                    <div class="row justify-start w-100% flex-column">
                        <div class="col w-100 text-center flex-row space-between">
                            <h1>' . $popups->title . '</h1>
                            <div class="kruis"></div>
                        </div>
                        <div class="row h-100">
                            <div class="col flex-column h-100 w-50 space-between">
                                ' . $abouts . '
                            </div>
                            <div class="col justify-center w-50">
                                <h1>Stan Nooijen</h1>
                                <p class="w-85">' . $popups->text . '</p>
                            </div>
                        </div>
                        <div class="row w-100 space-between contact-about">
                            <p>06-23330185</p>
                            <p>Stan.nooijen@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>
        ';
        }

        if ($popup_name == 'projects') {
            $abouts = '';
            foreach ($popup_details as $popup_detail) {
                $int = 1;
                $values = explode(',', $popup_detail->value);
                $abouts .= '
            <div class="list gap-1 flex-column">
                <h3>' . $popup_detail->label . '</h3>
                <ol class="list w-75 gap-1">';
                foreach ($values as $value) {
                    $number = $int . '. ';

                    $abouts .= '<ul>' . $number . $value . '</ul>';
                    $int++;
                }
                $abouts .= '</ol>
            </div>';
            }
            $html ='
            <div class="popup" id="'. $popup_name .'_popup">
                <div class="container">
                    <div class="row justify-start w-100% flex-column">
                        <div class="col w-100 text-center flex-row space-between">
                            <h1>' . $popups->title . '</h1>
                            <div class="kruis"></div>
                        </div>
                        <div class="row h-100">
                            <div class="col flex-column h-100 w-50 space-between">
                                ' . $abouts . '
                            </div>
                            <div class="col justify-center w-50">
                                <h1>Over...</h1>
                                <p class="w-85">' . $popups->text . '</p>
                            </div>
                        </div>
                        <div class="row w-100 space-between contact-about">
                            <p>06-23330185</p>
                            <p>Stan.nooijen@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>
        ';
        }

        return $html;
    }
}
