<?php

namespace App\Blokken;

use App\Models\Blocks;
use App\Models\projects;
use App\Models\Skills;

class skills_block
{

    public function render_public_block($block_id, $block_name, $position){
        $block_content = blocks::where('block_id', $block_id)->where('position', $position)->where('type', $block_name)->first();
        $hardskills = Skills::where('type', 'hard')->where('block_id', $block_id)->get();
        $softskills = Skills::where('type', 'soft')->where('block_id', $block_id)->get();
        $projects = projects::all();

        $html = '
    <div class="container skills-container" id="skills">
        <div class="line-down"></div>
        <div class="col skills-gap">
            <div class="skills-blocken-gap" >
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
                                        </div>';
                }
            }
            $html .= '<div class="skill ' . ($index === 0 ? 'active' : '') . '">
                                        <div class="space-between skills-tekst">
                                            <h1>' . $ball->title . '</h1>
                                            <p>'. $ball->years_experience .' : Jaar ervaring</p>
                                        </div>
                                        <div class="skill-flex">
                                            ' . $projectDetails . '
                                        </div>

                                    </div>';
        }
        $html .= '
            </div>
            <div id="Skill"><h1>Hard skills</h1></div>
        </div>
        <div class="skills-blocken-gap" >
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
}
