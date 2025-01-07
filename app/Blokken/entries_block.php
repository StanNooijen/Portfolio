<?php

namespace App\Blokken;

use App\Models\Entries;

class entries_block
{
    public function render_public_block($block_id, $block_name, $position)
    {
        $entries = Entries::where('block_id', $block_id)
            ->whereIn('type', ['career', 'education'])
            ->get()
            ->groupBy('type');

        $careers = $entries->get('career', collect());
        $education = $entries->get('education', collect());

        $html_career = $this->generateHtml($careers);
        $html_education = $this->generateHtml($education);

        $career_count = $careers->count();
        $education_count = $education->count();
        $max_count = max($career_count, $education_count);

        $circles_html = $this->generateCirclesHtml($max_count);

        $html = '
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

    private function generateHtml($entries)
    {
        $html = '';
        foreach ($entries as $entry) {
            $logo = $entry->logo ?? asset('images/Rectangle.png');
            $date = $entry->date ?? 'Heden';
            $html .= '
                <div class="col card">
                    <div class="flex-row gap-1">
                       <div class="logo" style="background-image: url(' . $logo . '); " >
                        </div>
                        <div class="w-100">
                            <div class="space-between">
                                <h2>' . $entry->title . '</h2>
                                <h3>' . $date . '</h3>
                            </div>
                            <p class="place">' . $entry->place . '</p>
                        </div>
                    </div>
                    <div class="info">
                        <p class="">
                            ' . $entry->text . '
                        </p>
                    </div>
                </div>';
        }
        return $html;
    }

    private function generateCirclesHtml($count)
    {
        $circles_html = '';
        for ($i = 0; $i < $count; $i++) {
            $circle_position = ($i * 275) - 20;
            $circles_html .= '<div class="circle" style="top: ' . $circle_position . 'px;"></div>';
        }
        return $circles_html;
    }

    public function render_cms_block($entries_id, $type)
    {
        $data = Entries::where('entry_id', $entries_id)->where('type', $type)->first();
        $types = Entries::distinct()->pluck('type');
        $type_options = '';

        foreach ($types as $type) {
            $selected = $data->type === $type ? 'selected' : '';
            $type_options .= '<option value="' . $type . '" ' . $selected . '>' . ucfirst($type) . '</option>';
        }

        $html = '
        <div class="row display-block w-100 h-100">
                <form class="flex-column gap-1 w-100 h-100 h-100" action="/entrieSave" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="entry_id" value="' . $entries_id . '">
                    ' . csrf_field() . '
                            <div class="flex-row gap-1 h-100">
                                <div class="flex-column gap-1 h-100 w-100">
                                    <div class="flex-row gap-1 space-between">
                                        <div class="flex-column bg-content rounded p-2 w-100">
                                            <label for="title" class="form-label ">Titel</label>
                                            <input type="text" class="form-control" id="title" name="title" value="' . ($data->title ?? 'title') . '">
                                        </div>
                                        <div class="bg-content rounded p-2 gap-1 flex-column w-100">
                                            <div class="flex-column rounded w-100">
                                                <label for="place" class="form-label">Place</label>
                                                <input type="text" class="form-control" id="place" name="place" value="' . ($data->place ?? 'place' ).' ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-row gap-1 w-100 justify-center">
                                        <div class="flex-column justify-center rounded gap-1 bg-content p-2 w-100">
                                            <label for="start_date" class="form-label ">Start Date</label>
                                            <input type="date" class="form-control" id="start_date" name="start_date" value="' . ($data->start_date ?? 'start_date') . '">
                                        </div>
                                        <div class="flex-column rounded justify-center gap-1 bg-content p-2 w-100">
                                            <label for="end_date" class="form-label ">End Date</label>
                                            <input type="date" class="form-control" id="end_date" name="end_date" value="' . ($data->end_date ?? 'end_date') . '">
                                        </div>
                                    </div>
                                    <div class="flex-column rounded justify-center gap-1 bg-content p-2 w-100">
                                        <label for="Type" class="form-label ">Type</label>
                                        <select id="type" name="type" class="form-control">
                                            ' . $type_options . '
                                        </select>
                                    </div>
                                    <div class="flex-column rounded bg-content p-1 gap-1 w-100 justify-center">
                                        <label for="image1" class="form-label justify-center">' . ($data->logo ?? 'No logo') . '</label>
                                        <input type="file" class="form-control" id="image1" name="image1" value="' . ($data->logo) . '">
                                        <div class="flex-row gap-1">
                                            <label for="image1" class="form-label CustomInput">logo</label>
                                            <label for="image1" class="form-label CustomInput danger">Delete</label>
                                        </div>
                                    </div>
                                    <button class="button" type="submit">opslaan</button>
                                </div>
                                <div class="flex-column bg-content rounded p-2 w-60">
                                    <label for="editordata" class="form-label ">Tekst vak</label>
                                    <textarea id="summernote" name="editordata">' . ($data->text ?? 'text') . '</textarea>
                                </div>
                            </div>
                </form>
            </div>
        ';
        return $html;
    }
}
