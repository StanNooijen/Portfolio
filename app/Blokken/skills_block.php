<?php

namespace App\Blokken;

use App\models\Skills;

class skills_block
{

    public function render_public_block($block_id, $block_name, $position){
        $hardskills = Skills::where('type', 'hard')->where('block_id', $block_id)->get();

        $softskills = Skills::where('type', 'soft')->where('block_id', $block_id)->get();

        $html = '
    <div class="container" style="position: relative" id="skills">
        <div class="col gap w-100 align-center">
            <div class="col w-80 gap">
                <div class="row gap" id="ball1">';
                foreach ($hardskills as $index => $ball) {
                    $html .= '<button class="ball ' . ($index === 0 ? 'active' : '') . '"
                            onclick="changeSkill(' . $index . ', \'skills1\', \'ball1\')"
                            style="background-image: url(' . asset("images/hardSkills/" . $ball->logo . ".png") . ')"></button>';
                }
                $html .= '</div>
                <div class="row skills" id="skills1">';
                foreach ($hardskills as $index => $ball) {
                    $html .= '<div class="skill ' . ($index === 0 ? 'active' : '') . '">
                            <div class="space-between">
                                <h2>' . $ball->title . '</h2>
                            </div>
                            <p class="w-85">
                                ' . $ball->text . '
                            </p>
                        </div>';
                }
        $html .= '</div>
                <h1 class="poppins-bold text-end subtitle" id="hardSkill">Hard skills</h1>
            </div>
            <div class="col w-80 justify-start gap">
                <h1 class="poppins-bold subtitle" id="softSkill">Soft skills</h1>
                <div class="row skills" id="skills2">';
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
        $html .= '</div>
                <div class="row gap" id="ball2">';
            foreach ($softskills as $index => $ball) {
                $html .= '<button class="ball ' . ($index === 0 ? 'active' : '') . '"
                        onclick="changeSkill(' . $index . ', \'skills2\', \'ball2\')"
                        style="background-image: url(' . asset("images/softSkills/" . $ball->logo . ".png") . ')"></button>';
            }
            $html .= '</div>
                </div>
            </div>
        </div>';
        return $html;
    }
}
