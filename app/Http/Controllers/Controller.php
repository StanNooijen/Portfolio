<?php

// app/Http/Controllers/Controller.php
namespace App\Http\Controllers;

use App\Models\Blocks;
use App\Models\Navbars;
use App\Models\Popups;
use App\Models\Projects;
use App\Models\Skills;

class Controller
{
    public function getData()
    {
        $blocks = Blocks::orderBy('position', 'asc')->get();
        $Navbar = Navbars::where('active', '1')->get();
        $popups = Popups::where('active', '1')->get();

        if ($blocks->isEmpty()) {
            return view('default');
        }
        $htmlArray = [];

        $searchNavbar = new \App\Blokken\Navbar();
        $ActiveNavbar = $Navbar->first();
        if(class_exists('App\\Blokken\\Navbar')) {
            $instance = new $searchNavbar();
            if (method_exists($instance, $ActiveNavbar->position)) {
                $htmlArray[] = $instance->{$ActiveNavbar->position}($ActiveNavbar->navbar_id);
            } else {
                echo 'Method '. $ActiveNavbar->position .' does not exist in class';
            }
        }

        foreach ($blocks as $block) {
            $block_Name = $block->type;
            $position = $block->position;
            $block_Name_sub = $block_Name . '_block';

            $className = 'App\\Blokken\\' . $block_Name_sub;

            if (class_exists($className)) {
                $instance = new $className();
                if (method_exists($instance, 'render_public_block')) {
                    $htmlArray[] = $instance->render_public_block($block->block_id, $block_Name,$position);
                } else {
                    echo 'Method render_public_block does not exist in class ' . $className;
                }
            } else {
                dd('Class ' . $className . ' does not exist');
            }
        }
        $SearchPopup = new \App\Blokken\popup_block();
        if (class_exists('App\\Blokken\\popup_block')) {
            foreach ($popups as $popup) {
                $instance = new $SearchPopup();
                if (method_exists($instance, 'render_public_popup')) {
                    $htmlArray[] = $instance->render_public_popup($popup->popup_id, $popup->title, $popup->position);
                } else {
                    echo 'Method render_public_popup does not exist in class';
                }
            }
        }

        if (!empty($blocks)) {
            $blocks = $blocks[0];
            return view('test', ['blocks' => $blocks, 'htmlArray' => $htmlArray]);
        }else{
            abort(404);
        }
    }
}
