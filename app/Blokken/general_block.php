<?php

namespace App\Blokken;

use App\models\blocks;
use App\models\contact;

class general_block
{
    public function render_public_block($block_id, $block_name, $position){
        $block_content = blocks::where('block_id', $block_id)->where('position', $position)->where('type', $block_name)->first();
        $socials = contact::all()->first();
        $imageUrl = asset('images/' . $block_content->image);

        $socialButton = '';

        if ($socials) {
            $socials->social_media = explode(',', $socials->social_media);
            $socials->social_links = explode(',', $socials->social_links);

            for ($i = 0; $i < count($socials->social_media); $i++) {
                $socialButton .= '<div class="blokje">
                                        <a href="'. $socials->social_links[$i] .'" target="_blank" class="social-icon">
                                            <img src="'. asset('images/socials/' . $socials->social_media[$i] . '.png') .'" alt="'. $socials->social_media[$i] .'">
                                        </a>
                                  </div>';
            }
        }

        $html = '
            <div class="container " id="about">
                    <div class="line-down">
                        <div class="follow_ball"></div>
                    </div>
                    <div class="row">
                        <div class="shadow-bottom">
                            <img src="' . $imageUrl . '" alt="" style="height: 100%">
                        </div>
                        <div class="intro w-40">
                            <h1 class="title poppins-bold">'. $block_content->title .'</h1>
                            <div class="textBox">
                                '. $block_content->text .'
                            </div>
                            <div class="row gap-5 justify-start m-l-15">
                                '. $socialButton .'
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
