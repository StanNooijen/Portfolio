<?php

namespace App\Blokken;

use App\models\Skills;

class skills_block
{

    public function render_public_block($block_id, $block_name, $position){
        $hardskills = Skills::where('type', 'hard')->where('block_id', $block_id)->get();

        $softskills = Skills::where('type', 'soft')->where('block_id', $block_id)->get();

        $html = '
    <div class="container" id="skills">
        <div class="line-down"></div>
        <div class="col">
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
                    $html .= '<div class="skill ' . ($index === 0 ? 'active' : '') . '">
                                            <div class="space-between">
                                                <h2>' . $ball->title . '</h2>
                                                <p>'. $ball->years_experience .' : Jaar ervaring</p>
                                            </div>
                                            <p class="w-85">
                                                ' . $ball->text . '
                                            </p>
                                        </div>';
                }
                $html .= '
            </div>
            <h1 id="hardSkill">Hard skills</h1>
            <h1 id="softSkill" class="justify-end">Soft skills</h1>
                <div class="col skills" id="skills2">';
                    foreach ($softskills as $index => $ball) {
                        $html .= '<div class="skill ' . ($index === 0 ? 'active' : '') . '">
                                                    <div class="space-between">
                                                        <h2>' . $ball->title . '</h2>
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
        </div>';
        return $html;
    }
}
