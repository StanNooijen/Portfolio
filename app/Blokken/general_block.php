<?php

namespace App\Blokken;

use App\Models\blocks;
use App\Models\contact;

class general_block
{
    public function render_public_block($block_id, $block_name, $position){
        $block_content = blocks::where('block_id', $block_id)->where('position', $position)->where('type', $block_name)->first();
        $socials = contact::all()->first();
        $imageUrl = asset($block_content->image);

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

    public function render_cms_block($block_id, $block_name, $position){
        $data = blocks::where('block_id', $block_id)->where('position', $position)->where('type', $block_name)->first();

        $html = '
            <div class="row w-100">
                <form class="flex-column gap-1 w-100" action="/updatenBlok" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="block_id" value="' . $block_id . '">
                    <input type="hidden" name="position" value="' . $position . '">
                    <input type="hidden" name="type" value="' . $block_name . '">
                    ' . csrf_field() . '
                            <div class="flex-row gap-1">
                                <div class="flex-column w-100">
                                    <label for="title" class="form-label ">Titel</label>
                                    <input type="text" class="form-control" id="title" name="title" value="' . ($data->title ?? 'title') . '">
                                </div>
                                <div class="flex-column w-100">
                                    <label for="place_name" class="form-label ">Plaatsnaam</label>
                                    <input type="text" class="form-control" id="place_name" name="place_name" value="' . ($data->place_name ?? 'place name') . '">
                                </div>
                            </div>
                            <div class="flex-column w-100">
                                <label for="place_name" class="form-label ">Tekst vak</label>
                                <textarea id="summernote" name="editordata">' . ($data->text ?? 'text') . '</textarea>
                            </div>

                            <div class="flex-row gap-1">
                                <div class="flex-column w-100">
                                <label for="button_text" class="form-label ">Button tekst</label>
                                <input type="text" class="form-control" id="button_text" name="button_text" value="' . ($data->button_text ?? 'button_text') . '">
                                </div>
                                <div class="flex-column w-100">
                                    <label for="image" class="form-label justify-center">' . ($data->image ?? 'nog geen afbeelding') . '</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    <label for="image" class="form-label CustomInput">Afbeelding</label>
                                </div>
                            </div>
                        <div>
                            <button class="button" type="submit">opslaan</button>
                        </div>
                </form>
            </div>
        ';
        return $html;
    }
}
