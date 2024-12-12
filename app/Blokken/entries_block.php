<?php

namespace App\Blokken;

use App\Models\Entries;

class entries_block
{
    public function render_public_block($block_id, $block_name, $position)
    {
        $careers = Entries::where('type', 'career')->get();
        $education = Entries::where('type', 'education')->get();

        $html = '';
        $html_career = '';
        foreach ($careers as $career) {
            $logo = null;
            if($career->logo == null) {
                $logo = asset('images/Rectangle.png');
            }else {
                $logo = $career->logo;
            }
            if ($career->date == null) {
                $career->date = 'Heden';
            }
            $html_career .= '
                    <div class="col card">
                        <div class="flex-row gap-1">
                            <img src="' . $logo . '" alt="'. $career->title .'">
                            <div class="w-100">
                                <div class="space-between">
                                    <h2>' . $career->title . '</h2>
                                    <h3>' . $career->date . '</h3>
                                </div>
                                <p class="place">' . $career->place . '</p>
                            </div>

                        </div>
                        <div class="info">
                            <p class="">
                                ' . $career->text . '
                            </p>
                        </div>
                    </div>';
        }

        $html_education = '';
        foreach ($education as $edu) {
            $logo = null;
            if($edu->logo == null) {
                $logo = asset('images/Rectangle.png');
            }else {
                $logo = $edu->logo;
            }
            if ($edu->date == null) {
                $edu->date = 'Heden';
            }
            $html_education .= '
                    <div class="col card">
                        <div class="flex-row gap-1">
                            <img src="' . $logo . '" alt="'. $edu->title .'">
                            <div class="w-100">
                                <div class="space-between">
                                    <h2>' . $edu->title . '</h2>
                                    <h3>' . $edu->date . '</h3>
                                </div>
                                <p class="place">' . $edu->place . '</p>
                            </div>
                        </div>
                        <div class="">
                            <p class="">
                                ' . $edu->text . '
                            </p>
                        </div>
                    </div>';
        }

        $career_count = $careers->count();
        $education_count = $education->count();
        $max_count = max($career_count, $education_count);

        $circles_html = '';
        for ($i = 0; $i < $max_count; $i++) {
            $circle_position = ($i * 275) + -20; // Adjust the multiplier and offset as needed
            $circles_html .= '<div class="circle" style="top: ' . $circle_position . 'px;"></div>';
        }

        $html .= '
            <div class="container" id="carriere">

                <div class="row align-start">
                    <div class="vertical-line"></div>
                    <div class="col align-center career">
                        <h1>Carrière</h1>
                        '. $html_career .'
                    </div>
                    <div class="line-down">
                        '. $circles_html .'
                    </div>
                    <div class="col align-center education">
                        <h1>Opleiding</h1>
                        '. $html_education .'
                    </div>
                </div>
            </div>';

        return $html;
    }
}
