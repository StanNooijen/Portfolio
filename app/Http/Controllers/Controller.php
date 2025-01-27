<?php

namespace App\Http\Controllers;

use App\Models\Blocks;
use App\Models\Entries;
use App\Models\Navbars;
use App\Models\Popups;
use App\Models\Popups_details;
use App\Models\Projects;
use App\Models\Skills;
use Illuminate\Support\Facades\Cache;

class Controller
{

    public function getData()
    {
        $data = Cache::remember('starting_page_data', 60, function () {
            return [
                'blocks' => Blocks::select('type', 'position', 'block_id')->orderBy('position', 'asc')->get(),
                'navbar' => Navbars::select('navbar_id', 'position')->where('active', '1')->first(),
                'popups' => Popups::select('popup_id', 'title')->where('active', '1')->get(),
            ];
        });

        if ($data['blocks']->isEmpty()) {
            return view('default');
        }

        $htmlArray = Cache::remember('starting_page_html', 60, function () use ($data) {
            $htmlArray = [];

            // Process navbar
            if ($data['navbar']) {
                $searchNavbar = new \App\Blokken\Navbar();
                $activeNavbar = $data['navbar'];
                if (method_exists($searchNavbar, $activeNavbar->position)) {
                    $htmlArray[] = $searchNavbar->{$activeNavbar->position}($activeNavbar->navbar_id);
                }
            }

            // Process blocks
            foreach ($data['blocks'] as $block) {
                $blockName = $block->type;
                $position = $block->position;
                $blockNameSub = $blockName . '_block';

                $className = 'App\\Blokken\\' . $blockNameSub;

                if (class_exists($className)) {
                    $instance = new $className();
                    if (method_exists($instance, 'render_public_block')) {
                        $htmlArray[] = $instance->render_public_block($block->block_id, $blockName, $position);
                    }
                }
            }

            // Process popups
            $searchPopup = new \App\Blokken\popup_block();
            foreach ($data['popups'] as $popup) {
                if (method_exists($searchPopup, 'render_public_popup')) {
                    $htmlArray[] = $searchPopup->render_public_popup($popup->popup_id, $popup->title, $popup->position);
                }
            }

            return $htmlArray;
        });

        if (!empty($data['blocks'])) {
            $blocks = $data['blocks'][0];
            return view('test', ['blocks' => $blocks, 'htmlArray' => $htmlArray]);
        } else {
            abort(404);
        }
    }

    public function getDataAdmin() {
        $blocks = Blocks::orderBy('position', 'asc')->get();
        $entries = Entries::all(); // Assuming you need entries data
        $popups = Popups::all(); // Assuming you need popups data

        return view('dashboard', [
            'blocks' => $blocks,
            'entries' => $entries,
            'popups' => $popups
        ]);
    }

    public function block($block_id) {
        $block = Blocks::where('block_id',$block_id)->get();
        $popups = Popups::where('block_id',$block_id)->get();

        $html = '';
        foreach($block as $blocks) {
            $blockName = $blocks->type;
            $position = $blocks->position;
            $blockNameSub = $blockName . '_block';

            $className = 'App\\Blokken\\' . $blockNameSub;

            if (class_exists($className)) {
                $instance = new $className();
                if (method_exists($instance, 'render_cms_block')) {
                    $html = $instance->render_cms_block($blocks->block_id, $blockName, $position);
                } else {
                    echo 'Method render_cms_block does not exist in class ' . $className;
                }
            } else {
                dd('Class ' . $className . ' does not exist');
            }
        }
        return view('block', ['block' => $block, 'popups' => $popups, 'html' => $html]);
    }

    public function popup($popup_id, $title) {
        $popup = Popups::where('popup_id',$popup_id)->get();

        $html = '';
        foreach($popup as $popups) {
            $blockName = $popups->type;

            $className = 'App\\Blokken\\popup_block';

            if (class_exists($className)) {
                $instance = new $className();
                if (method_exists($instance, 'render_cms_block')) {
                    $html = $instance->render_cms_block($popups->popup_id, $blockName);
                } else {
                    echo 'Method render_cms_block does not exist in class ' . $className;
                }
            } else {
                dd('Class ' . $className . ' does not exist');
            }
        }
        return view('block', ['block' => $popup, 'html' => $html]);
    }

    public function entrie($entrie_id) {
        $entry = Entries::where('entry_id',$entrie_id)->get();

        $html = '';
        foreach($entry as $entries) {
            $type = $entries->type;

            $className = 'App\\Blokken\\entries_block';

            if (class_exists($className)) {
                $instance = new $className();
                if (method_exists($instance, 'render_cms_block')) {
                    $html = $instance->render_cms_block($entries->entry_id, $type);
                } else {
                    echo 'Method render_cms_block does not exist in class '. $className;
                }
            } else {
                dd('Class '. $className.'does not exist');
            }
        }
        return view('block', ['block' => $entry, 'html' => $html]);
    }


    public function skill($skill_id) {
        $skill = Skills::where('skills_id',$skill_id)->get();
        $popups = Popups::where('block_id',$skill_id)->where('exclude', '!=', $skill_id)->get();
        return view('skill', ['skill' => $skill, 'popups' => $popups]);
    }

}
