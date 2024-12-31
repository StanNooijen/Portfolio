<?php

namespace App\Blokken;

use App\Models\Blocks;
use App\Models\Popups;
use App\Models\Popups_details;
use App\Models\Projects;
use App\Models\Skills;

class popup_block
{
    public function render_public_popup($popup_id, $popup_name, $position)
    {
        $popups = Popups::with('details')->where('title', $popup_name)->first();

        $popup_details = Popups_details::where('popup_id', $popups->popup_id)->get();
        $html = '';
        if ($popup_id == '1') {
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
            <div class="popup" id="about_me_popup">
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
        } else {
            $info = '';
            $images = '';
            foreach ($popup_details as $popup_detail) {
                $int = 1;
                $values = explode(',', $popup_detail->value);

                $img1 = $popup_detail->image_1 ?: asset('images/Rectangle.png');
                $img2 = $popup_detail->image_2 ?: asset('images/Rectangle.png');

                $images = '
                                <div class="row h-100">
                                    <img class="h-100" src="' . $img1 . '" alt="' . $img1 . '">
                                    <img class="h-100" src="' . $img2 . '" alt="' . $img2 . '">
                                </div>
                ';

                $info .= '
                <div class="list gap-1 flex-column">
                    <h3>' . $popup_detail->label . '</h3>
                    <ol class="list w-75 gap-1">';
                foreach ($values as $value) {
                    $number = $int . '. ';

                    $info .= '<ul>' . $number . $value . '</ul>';
                    $int++;
                }
                $info .= '</ol>
                </div>';
            }
            $html ='
            <div class="popup" id="'. $popup_name .'">
                <div class="container">
                    <div class="row justify-start w-100% flex-column">
                        <div class="col w-100 text-center flex-row space-between">
                            <h1>' . $popups->title . '</h1>
                            <div class="kruis"></div>
                        </div>
                        <div class="row h-100">
                            <div class="col flex-column h-100 w-50 gap-1">
                                ' . $info . '
                                '. $images .'
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

    public function render_cms_block($popup_id, $block_name){
        $data = popups::where('popup_id', $popup_id)->first();
        $details = Popups_details::where('popup_id', $popup_id)->get();
        $project = projects::where('title', $data->title)->first();
        $skills = Skills::where('type', 'hard')->get();

        $dropdown = '';
        foreach ($skills as $skill) {
            $dropdown .= '<option value="' . $skill->title . '">' . $skill->title . '</option>';
        }

        if ($popup_id == '1') {

            $detailIds = $details->pluck('detail_id')->toArray();
            $detailIdsJson = json_encode($detailIds);

            $labels = '';
            foreach ($details as $detail) {

                $buttons = '';
                    $values = explode(',', $detail->value);
                    foreach ($values as $value) {
                        $buttons .= '
                    <div class="button gap-1 align-items-center">' . $value . '<i class="fa-solid fa-xmark"></i></div>
                ';
                }
                $labels .= '
                                    <div class="bg-content rounded p-2 gap-1 flex-column">
                                        <div class="flex-column rounded w-100">
                                            <label for="label" class="form-label ">label</label>
                                            <input type="text" class="form-control" id="label" name="label_' . $detail->detail_id . '" value="' . ($detail->label ?? 'label') . '">
                                        </div>
                                        <div class="flex-row flex-wrap gap-1 align-items-center space-between w-100">
                                            <div id="languages" class="flex-row flex-wrap gap-1 align-items-center">
                                                ' . $buttons . '
                                            </div>
                                            <input type="text" id="thingsInput" class="form-control" placeholder="Enter language and press Enter">
                                            <input type="hidden" name="labels_input_' . $detail->detail_id . '" value="' . ($detail->value ?? '') . '">
                                        </div>
                                    </div>
                                    ';
            }
            $html = '
            <div class="row display-block w-100">
                <form class="flex-column gap-1 w-100" action="/skillPopup" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="popup_id" value="' . $popup_id . '">
                    <input type="hidden" name="type" value="' . $block_name . '">
                    <input type="hidden" name="detail_ids" value=\'' . $detailIdsJson . '\'>
                    ' . csrf_field() . '
                            <div class="flex-row gap-1">
                                <div class="flex-column gap-1 w-100">
                                    <div class="flex-column bg-content rounded p-2 w-100">
                                        <label for="title" class="form-label ">Titel</label>
                                        <input type="text" class="form-control" id="title" name="title" value="' . ($data->title ?? 'title') . '">
                                    </div>
                                    ' . $labels . '
                                    <button class="button" type="submit">opslaan</button>
                                </div>
                                <div class="flex-column bg-content rounded p-2 w-60">
                                    <label for="place_name" class="form-label ">Tekst vak</label>
                                    <textarea id="summernote" name="editordata">' . ($data->text ?? 'text') . '</textarea>
                                </div>
                            </div>
                </form>
            </div>
            ';
        }
        else {
            $buttons = '';
            $values = explode(',', $details->first()->value);
            foreach ($values as $value) {
                $buttons .= '
                    <div class="button gap-1 align-items-center">' . $value . '<i class="fa-solid fa-xmark"></i></div>
                ';
            }
            $html = '
            <div class="row display-block w-100">
                <form class="flex-column gap-1 w-100" action="/skillPopup" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="popup_id" value="' . $popup_id . '">
                    <input type="hidden" name="type" value="' . $block_name . '">
                    <input type="hidden" name="project_id" value="' . $project->project_id . '">
                    ' . csrf_field() . '
                            <div class="flex-row gap-1">
                                <div class="flex-column gap-1 w-100">
                                    <div class="flex-row gap-1 space-between">
                                        <div class="flex-column bg-content rounded p-2 w-100">
                                            <label for="title" class="form-label ">Titel</label>
                                            <input type="text" class="form-control" id="title" name="title" value="' . ($data->title ?? 'title') . '">
                                        </div>
                                    </div>
                                    <div class="bg-content rounded p-2 gap-1 flex-column">
                                        <div class="flex-column rounded w-100">
                                            <label for="label" class="form-label ">label</label>
                                            <input type="text" class="form-control" id="label" name="label" value="' . ($details->first()->label ?? 'label') . '">
                                        </div>
                                        <div class="flex-row flex-wrap gap-1 align-items-center space-between w-100">
                                            <div id="languages" class="flex-row flex-wrap gap-1 align-items-center">
                                                '. $buttons .'
                                                <input type="hidden" name="languages" value="' . ($details->first()->value ?? '') . '">
                                            </div>
                                            <button class="AddButton"></button>
                                            <select id="languageDropdown" class="form-control" style="display: none;">
                                                ' . $dropdown . '
                                            </select>
                                        </div>
                                    </div>
                                    <div class="flex-row gap-1">
                                        <div class="flex-column bg-content rounded p-2 w-100">
                                            <label for="title" class="form-label ">Github url</label>
                                            <input type="text" class="form-control" id="url" name="url" value="' . ($details->first()->button_link ?? 'github url') . '">
                                        </div>
                                        <div class="flex-column bg-content rounded p-2 w-100">
                                            <label for="short-description" class="form-label ">short-description</label>
                                            <input type="text" class="form-control" id="short-description" name="short-description" value="' . ($project->text ?? 'short-description') . '">
                                        </div>
                                    </div>
                                    <div class="flex-row gap-1 align-items-center space-between bg-content rounded p-2 w-100">
                                        <div class="flex-column gap-1 w-100">
                                            <label for="image1" class="form-label justify-center">' . ($details->first()->image_1 ?? 'No image 1') . '</label>
                                            <input type="file" class="form-control" id="image1" name="image1" value="' . ($details->first()->image_1) . '">
                                            <div class="flex-row gap-1">
                                                <label for="image1" class="form-label CustomInput">Image</label>
                                                <label for="image1" class="form-label CustomInput danger">Delete</label>
                                            </div>
                                        </div>
                                        <div class="flex-column gap-1 w-100">
                                            <label for="image2" class="form-label justify-center">' . ($details->first()->image_2 ?? 'No image 2') . '</label>
                                            <input type="file" class="form-control" id="image2" name="image2" value="' . ($details->first()->image_2) . '">
                                            <div class="flex-row gap-1">
                                                <label for="image2" class="form-label CustomInput">Image</label>
                                                <label for="image2" class="form-label CustomInput danger">Delete</label>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="button" type="submit">opslaan</button>
                                </div>
                                <div class="flex-column bg-content rounded p-2 w-60">
                                    <label for="place_name" class="form-label ">Tekst vak</label>
                                    <textarea id="summernote" name="editordata">' . ($data->text ?? 'text') . '</textarea>
                                </div>
                            </div>
                </form>
            </div>
        ';
        }

        return $html;
    }
}
