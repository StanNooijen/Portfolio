<?php

namespace App\Blokken;

use App\models\Skills;
use App\models\projects;

class skills_block
{

    public function render_public_block($block_id, $block_name, $position){
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
                $programming_languages = explode(',', $project->programming_languages);
                if (in_array($ball->title, $programming_languages)) {
                    $projectDetails .= '<div class="project-details">
                                            <h3>' . $project->title . '</h3>
                                            <p>Languages: ' . implode(', ', $programming_languages) . '</p>
                                        </div>';
                }
            }
            $html .= '<div class="skill ' . ($index === 0 ? 'active' : '') . '">
                                        <div class="space-between">
                                            <h2>' . $ball->title . '</h2>
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
                                                        <div class="space-between">
                                                            <h1>' . $ball->title . '</h1>
                                                        </div>
                                                        <p class="w-85">
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
    </div>';
        return $html;
    }
}
