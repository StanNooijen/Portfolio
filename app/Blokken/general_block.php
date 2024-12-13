<?php

namespace App\Blokken;

use App\Models\blocks;
use App\Models\contact;

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

            <div class="container " id="about_me">
                <div class="line-down"></div>
                    <div class="row">
                        <div>
                            <img src="' . $imageUrl . '" alt="" style="width: 90dvh">
                        </div>
                        <div class="intro col">
                            <div>

                                <h1 class="title">'. $block_content->title .'

                                </h1>
                                <p class="plaatsNaam">'. $block_content->place_name .'</p>
                            </div>
                            <div class="textBox">
                                <p>'. $block_content->text .'</p>
                            </div>
                            <div class="row">
                                '. $socialButton .'
                            </div>
                            <div class="justify-end">
                                <div class="background-black">
                                    <button id="meerOverMijButton" class="meerOverMijButton button poppins-regular">'. $block_content->button_text .'
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        ';
        return $html;
    }
}
