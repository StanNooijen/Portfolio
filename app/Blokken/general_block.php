<?php

namespace App\Blokken;

use App\models\blocks;

class general_block
{
    public function render_public_block($block_id, $block_name, $position){
        $block_content = blocks::where('block_id', $block_id)->where('position', $position)->where('type', $block_name)->first();
        $imageUrl = asset('images/' . $block_content->image);

        $html = '
            <div class="container " id="about">
                    <div class="line-down"></div>
                    <div class="row">
                        <div class="shadow-bottom">
                            <img src="' . $imageUrl . '" alt="" style="height: 100%">
                        </div>
                        <div class="intro w-40">
                            <h1 class="title poppins-bold">'. $block_content->title .'</h1>
                            <div class="textBox">
                                '. $block_content->text .'
                            </div>
                            <div class="justify-end">
                                <button id="meerOverMijButton" class="meerOverMijButton button poppins-regular">'. $block_content->button_text .'
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        ';
        return $html;
    }
}
