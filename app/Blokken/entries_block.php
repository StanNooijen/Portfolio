<?php

namespace App\Blokken;

use App\Models\Entries;

class entries_block
{
    public function render_public_block($block_id, $block_name, $position)
    {
        $entries = Entries::get()
            ->groupBy('type');

        $careers = $entries->get('career', collect());
        $careers = $careers->sortByDesc('start_date');
        $education = $entries->get('education', collect());
        $education = $education->sortByDesc('start_date');

        $html_career = $this->generateHtml($careers);
        $html_education = $this->generateHtml($education);

        $html = '
            <div class="container" id="carriere">
                <div class="row gap-2 align-start">
                    <div class="vertical-line"></div>
                    <div class="col align-center career">
                        <h1>Carrière</h1>
                        '. $html_career .'
                    </div>
                    <div class="line-down">
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
            $entryText = '';
            $logo = '';
            if ($entry->text) {
                $entryText = '
                <div class="info">
                    <p class="">
                        ' . $entry->text . '
                    </p>
                </div>';
            }

            if ($entry->logo){
                $logo = '<div class="logo" style="background-image: url(' . $entry->logo . ');"></div>';
            } else {
                $logo = '';
            }

            $end_date = $entry->end_date ?? 'Heden';
            $html .= '
                <div class="col w-100 card">
                    <div class="flex-row gap-1">
                       ' . $logo . '
                        <div class="w-100">
                            <div class="space-between">
                                <h2>' . $entry->title . '</h2>
                                <div class="flex-row gap-1 h-100 align-items-center">
                                    <h4>' . $entry->start_date . '</h4>
                                    <div class="timeStamp"></div>
                                    <h4>' . $end_date . '</h4>
                                </div>
                            </div>
                            <p class="place">' . $entry->place . '</p>
                        </div>
                    </div>
                    ' . $entryText . '
                </div>';
        }
        return $html;
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
                                            <input type="month" class="form-control" id="start_date" name="start_date" value="' . ($data->start_date ?? 'start_date') . '">
                                        </div>
                                        <div class="flex-column rounded justify-center gap-1 bg-content p-2 w-100">
                                            <label for="end_date" class="form-label ">End Date</label>
                                            <input type="month" class="form-control" id="end_date" name="end_date" value="' . ($data->end_date ?? 'end_date') . '">
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
