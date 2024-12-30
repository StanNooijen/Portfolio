<?php

namespace App\Blokken;

use App\Models\Blocks;
use App\Models\Entries;

class entries_block
{
    public function render_public_block($block_id, $block_name, $position)
    {
        $block_content = Blocks::where('block_id', $block_id)
            ->where('position', $position)
            ->where('type', $block_name)
            ->first();

        $entries = Entries::where('block_id', $block_id)
            ->whereIn('type', ['career', 'education'])
            ->get()
            ->groupBy('type');

        $careers = $entries->get('career', collect());
        $education = $entries->get('education', collect());

        $html = '';
        $html_career = '';
        foreach ($careers as $career) {
            $logo = $career->logo ?? asset('images/Rectangle.png');
            $date = $career->date ?? 'Heden';
            $html_career .= '
                <div class="col card">
                    <div class="flex-row gap-1">
                        <img src="' . $logo . '" alt="'. $career->title .'">
                        <div class="w-100">
                            <div class="space-between">
                                <h2>' . $career->title . '</h2>
                                <h3>' . $date . '</h3>
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
            $logo = $edu->logo ?? asset('images/Rectangle.png');
            $date = $edu->date ?? 'Heden';
            $html_education .= '
                <div class="col card">
                    <div class="flex-row gap-1">
                        <img src="' . $logo . '" alt="'. $edu->title .'">
                        <div class="w-100">
                            <div class="space-between">
                                <h2>' . $edu->title . '</h2>
                                <h3>' . $date . '</h3>
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
            $circle_position = ($i * 275) + -20;
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

    public function render_cms_block($block_id, $block_name, $position){
        $data = blocks::where('block_id', $block_id)->where('position', $position)->where('type', $block_name)->first();
        $html = '
        <div class="row w-100">
                <form class="flex-column gap-1 w-100" action="/updatenBlok" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="block_id" value="' . $block_id . '">
                    <input type="hidden" name="position" value="' . $position . '">
                    <input type="hidden" name="type" value="' . $block_name . '">
                    ' . csrf_field() . '
                            <div class="flex-row gap-1">
                                <div class="flex-column w-100">
                                    <label for="title" class="form-label ">Titel</label>
                                    <input type="text" class="form-control" id="title" name="title" value="' . ($data->title ?? 'title') . '">
                                </div>
                                <div class="flex-column w-100">
                                    <label for="place_name" class="form-label ">Plaatsnaam</label>
                                    <input type="text" class="form-control" id="place_name" name="place_name" value="' . ($data->place_name ?? 'place name') . '">
                                </div>
                            </div>
                            <div class="flex-column w-100">
                                <label for="place_name" class="form-label ">Tekst vak</label>
                                <textarea id="summernote" name="editordata">' . ($data->text ?? 'text') . '</textarea>
                            </div>

                            <div class="flex-row gap-1">
                                <div class="flex-column w-100">
                                <label for="button_text" class="form-label ">Button tekst</label>
                                <input type="text" class="form-control" id="button_text" name="button_text" value="' . ($data->button_text ?? 'button_text') . '">
                                </div>
                                <div class="flex-column w-100">
                                    <label for="image" class="form-label justify-center">' . ($data->image ?? 'nog geen afbeelding') . '</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    <label for="image" class="form-label CustomInput">Afbeelding</label>
                                </div>
                            </div>
                        <div>
                            <button class="button" type="submit">opslaan</button>
                        </div>
                </form>
            </div>
        ';
        return $html;
    }
}
