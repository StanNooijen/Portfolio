<?php

namespace App\Blokken;

use App\Models\Blocks;
use App\Models\Popups;
use App\Models\Popups_details;
use App\Models\Projects;
use App\Models\Skills;

class skills_block
{
    public function render_public_block($block_id, $block_name, $position)
    {
        $block_content = Blocks::where('block_id', $block_id)
            ->where('position', $position)
            ->where('type', $block_name)
            ->first();

        $skills = Skills::where('block_id', $block_id)
            ->whereIn('type', ['hard', 'soft'])
            ->get()
            ->groupBy('type');

        $hardskills = $skills->get('hard', collect());
        $softskills = $skills->get('soft', collect());
        $projects = Projects::all();

        $html = '
    <div class="container skills-container" id="skills">
        <div class="line-down"></div>
        <div class="col skills-gap">
            <div class="skills-blocken-gap">
                <div class="row space-between" id="ball1">';
        foreach ($hardskills as $index => $ball) {
            $html .= '<button class="ball ' . ($index === 0 ? 'active' : '') . '"
                                                onclick="changeSkill(' . $index . ', \'skills1\', \'ball1\')"
                                                style="background-image: url(' . asset("images/hardSkills/" . $ball->logo . ".png") . ')"></button>';
        }
        $html .= '
                    </div>
                    <div class="col skills" id="skills1">';
        foreach ($hardskills as $index => $ball) {
            $projectDetails = '';
            foreach ($projects as $project) {
                $languages = '';
                $programming_languages = explode(',', $project->programming_languages);
                foreach ($programming_languages as $programming_language) {
                    $languages .= '
                        <div class="language">
                            <p>' . $programming_language . '</p>
                        </div>
                    ';
                }
                if (in_array($ball->title, $programming_languages)) {
                    $projectDetails .= '<div class="project-details" onclick="activateProjectPopup(\''.$project->title.'\')">
                                            <div class="title-flex">
                                                <h2>' . $project->title . '</h2>
                                                <svg height="15" width="15" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                                  <path fill-rule="evenodd" d="M2.5 17.5a1 1 0 001.5 0l12-12v9.5a1 1 0 002 0v-12a1 1 0 00-1-1h-12a1 1 0 000 2h9.5l-12 12a1 1 0 000 1.5z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <div class="languages">'. $languages .'</div>
                                            <div class="description">
                                                <p>' . $project->text . '</p>
                                            </div>
                                        </div>';
                }
            }
            $html .= '<div class="skill ' . ($index === 0 ? 'active' : '') . '">
                                        <div class="space-between skills-tekst">
                                            <h1>' . $ball->title . '</h1>
                                            <p>'. $ball->years_experience .' : Jaar ervaring</p>
                                        </div>
                                        <div class="skill-flex space-between">
                                            ' . $projectDetails . '
                                        </div>
                                    </div>';
        }
        $html .= '
            </div>
            <div id="Skill"><h1>Hard skills</h1></div>
        </div>
        <div class="skills-blocken-gap">
            <div id="Skill" class="justify-end"><h1>Soft skills</h1></div>
                <div class="col skills" id="skills2">';
        foreach ($softskills as $index => $ball) {
            $html .= '<div class="skill ' . ($index === 0 ? 'active' : '') . '">
                                                        <div class="space-between skills-tekst">
                                                            <h1>' . $ball->title . '</h1>
                                                        </div>
                                                        <p>
                                                            ' . $ball->text . '
                                                        </p>
                                                    </div>';
        }
        $html .= '
                        </div>
                         <div class="row space-between" id="ball2">';
        foreach ($softskills as $index => $ball) {
            $html .= '<button class="ball ' . ($index === 0 ? 'active' : '') . '"
                                                            onclick="changeSkill(' . $index . ', \'skills2\', \'ball2\')"
                                                            style="background-image: url(' . asset("images/softSkills/" . $ball->logo . ".png") . ')"></button>';
        }
        $html .= '
                </div>
            </div>
        </div>
    </div>';
        return $html;
    }

    public function render_cms_block($popup_id, $block_name){
        $data = popups::where('popup_id', $popup_id)->first();
        $details = Popups_details::where('popup_id', $popup_id)->first();
        $skills = Skills::where('type', 'hard')->get();

        $dropdown = '';
        foreach ($skills as $skill) {
            $dropdown .= '<option value="' . $skill->title . '">' . $skill->title . '</option>';
        }



        $buttons = '';
        $values = explode(',', $details->value);
        foreach ($values as $value) {
            $buttons .= '
                <div class="button gap-1 align-items-center">' . $value . '<i class="fa-solid fa-xmark"></i></div>
            ';
        }
        if ($popup_id == '1') {
            $html = '';
        }
        else {
            $html = '
            <div class="row display-block w-100">
                <form class="flex-column gap-1 w-100" action="/skillPopup" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="popup_id" value="' . $popup_id . '">
                    <input type="hidden" name="type" value="' . $block_name . '">
                    <input type="hidden" name="languages" value="'. $details->value .'">
                    ' . csrf_field() . '
                            <div class="flex-row gap-1">
                                <div class="flex-column gap-1 w-100">
                                    <div class="flex-column bg-content rounded p-2 w-100">
                                        <label for="title" class="form-label ">Titel</label>
                                        <input type="text" class="form-control" id="title" name="title" value="' . ($data->title ?? 'title') . '">
                                    </div>
                                    <div class="flex-row gap-1 align-items-center space-between bg-content rounded p-2 w-100">
                                        <div id="languages" class="flex-row gap-1 align-items-center">
                                            <label for="title" class="form-label ">Languages</label>
                                            '. $buttons .'
                                        </div>
                                        <button class="AddButton"></button>
                                        <select id="languageDropdown" class="form-control" style="display: none;">
                                            ' . $dropdown . '
                                        </select>
                                    </div>
                                    <div class="flex-row gap-1 align-items-center space-between bg-content rounded p-2 w-100">
                                        <div class="flex-column gap-1 w-100">
                                            <label for="image1" class="form-label justify-center">' . ($details->image_1 ?? 'No image 1') . '</label>
                                            <input type="file" class="form-control" id="image1" name="image1" value="' . ($details->image_1) . '">
                                            <div class="flex-row gap-1">
                                                <label for="image1" class="form-label CustomInput">Image</label>
                                                <label for="image1" class="form-label CustomInput danger">Delete</label>
                                            </div>
                                        </div>
                                        <div class="flex-column gap-1 w-100">
                                            <label for="image2" class="form-label justify-center">' . ($details->image_2 ?? 'No image 2') . '</label>
                                            <input type="file" class="form-control" id="image2" name="image2" value="' . ($details->image_2) . '">
                                            <div class="flex-row gap-1">
                                                <label for="image2" class="form-label CustomInput">Image</label>
                                                <label for="image2" class="form-label CustomInput danger">Delete</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-column bg-content rounded p-2 w-100">
                                        <label for="title" class="form-label ">Github url</label>
                                        <input type="text" class="form-control" id="url" name="url" value="' . ($details->button_link ?? 'url') . '">
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
