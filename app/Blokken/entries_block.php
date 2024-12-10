<?php

namespace App\Blokken;


use App\Models\Entries;


class entries_block
{
    public function render_public_block($block_id, $block_name, $position)
    {
        $careers = Entries::where('type', 'career')->get();
        $education = Entries::where('type', 'education')->get();

        $html_career = '';
        foreach ($careers as $career) {
            if ($career->date == null) {
                $career->date = 'Heden';
            }
            $html_career .= '<div class="col">
                    <div class="Carriere">
                        <div class="space-between">
                            <h3>' . $career->date . '</h3>
                            <h2>' . $career->title . '</h2>
                        </div>
                        <p class="flex justify-end m-0 subText">' . $career->place . '</p>
                        <div class="info">
                            <p class="flex justify-end">
                                ' . $career->text . '
                            </p>
                        </div>
                    </div>
                </div>';
        }

        $html_education = '';
        foreach ($education as $edu) {
            if ($edu->date == null) {
                $edu->date = 'Heden';
            }
            $html_education .= '<div class="col">
                    <div class="Opleiding">
                        <div class="space-between">
                            <h2>' . $edu->title . '</h2>
                            <h3>' . $edu->date . '</h3>
                        </div>
                        <p class="flex m-0 subText">' . $edu->place . '</p>
                        <div class="">
                            <p class="flex width-80 ">
                                ' . $edu->text . '
                            </p>
                        </div>
                    </div>
                </div>';
        }

        $career_count = $careers->count();
        $education_count = $education->count();
        $max_count = max($career_count, $education_count);

        $container_height = ($max_count * 275) + 50; // Adjust the multiplier and offset as needed

        $circles_html = '';
        for ($i = 0; $i < $max_count; $i++) {
            $circle_position = ($i * 275) + -20; // Adjust the multiplier and offset as needed
            $circles_html .= '<div class="circle" style="top: ' . $circle_position . 'px;"></div>';
        }

        $html = '<div class="container align-end justify-start" style="height: ' . $container_height . 'px;" id="ervaring">
                <div class="row w-91 gap-10 h-100">
                    <div class="col h-100">
                        '. $html_career .'
                    </div>
                    <div class="line-down">
                        '. $circles_html .'
                    </div>
                    <div class="col h-100" style="gap: 50px">
                        '. $html_education .'
                    </div>
                </div>
            </div>';

        return $html;
    }
}
