<?php

namespace App\Blokken;

use App\models\Skills;

class skills_block
{
    //    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1640 200" width="1640" height="300">
//    <path d="M 0 300 Q 0 150 100 150 L 460 150 Q 520 150 520 0 Q 520 150 580 150 L 700 150 Q 820 150 820 300 "
//    fill="none" stroke="white" stroke-width="2"/>
//    </svg>
    public function render_public_block($block_id, $block_name, $position){
        $hardskills = Skills::where('type', 'hard')->where('block_id', $block_id)->get();

        $softskills = Skills::where('type', 'soft')->where('block_id', $block_id)->get();

        $html = '
    <div class="container" id="skills">
        <div class="col gap-5 w-100 align-center">
            <div class="col w-90" style="gap: 20px">
                <div class="row gap-3" id="ball1">';
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
            <div class="col w-90 justify-start" style="gap: 20px">
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
                <div class="row gap-3" id="ball2">';
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
