<?php

// app/Http/Controllers/Controller.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blocks;
use App\Models\Contact;
use App\Models\Entries;
use App\Models\Popups;
use App\Models\Projects;
use App\Models\Skills;
use App\Models\Popups_details;

class Controller
{
    public function getData()
    {
        $blocks = Blocks::orderBy('position', 'asc')->get();

        if ($blocks->isEmpty()) {
            return view('default');
        }

        $htmlArray = [];
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

        if (!empty($blocks)) {
            $blocks = $blocks[0];
            return view('test', ['blocks' => $blocks, 'htmlArray' => $htmlArray]);
        }else{
            abort(404);
        }
    }

    public function testdata()  {
        $hardskills = Skills::where('type', 'hard')->get();
        $softskills = Skills::where('type', 'soft')->get();

        $projecten = Projects::all();

        $projectenRijEen = $projecten->filter(function ($project, $index) {
            return $index % 2 == 0;
        });

        $projectenRijTwee = $projecten->filter(function ($project, $index) {
            return $index % 2 != 0;
        });

        // Convert Talen to array
        $projectenRijEen->each(function ($project) {
            $project->Programming_languages = explode(',', $project->Programming_languages);
        });

        $projectenRijTwee->each(function ($project) {
            $project->Programming_languages = explode(',', $project->Programming_languages);
        });



        return view('default', ['hardskills' => $hardskills, 'softskills' => $softskills , 'projectenRijEen' => $projectenRijEen, 'projectenRijTwee' => $projectenRijTwee]);
    }
}
