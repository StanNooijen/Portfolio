<?php

namespace App\Blokken;

use App\Models\Projects;

class projects_block
{
    public function render_public_block($block_id, $block_name, $position){
        $projecten = Projects::all();

        $ballen = ceil($projecten->count() / 2 - 1);


        $projectenRijEen = $projecten->filter(function ($project, $index) {
            return $index % 2 == 0;
        });

        $projectenRijTwee = $projecten->filter(function ($project, $index) {
            return $index % 2 != 0;
        });

        // Convert Programming_languages to array
        $projectenRijEen->each(function ($project) {
            $project->programming_languages = explode(',', $project->programming_languages);
        });

        $projectenRijTwee->each(function ($project) {
            $project->programming_languages = explode(',', $project->programming_languages);
        });

        return '
            <div class="container" id="projecten">
                <div class="projecten justify-center">
                    <div class="projectenPositie" id="projectenRijEen">
                        ' . $projectenRijEen->map(function ($project, $index) {
                $afbeelding = $project->image ?? 'Rectangle.png';
                $activeClass = $index == 0 ? 'active' : '';
                return '
                                <div class="project ' . $activeClass . '">
                                    <div class="projectTop">
                                        <div class="row space-between">
                                            <div class="col space-between h-100">
                                                <div class="Text justify-between h-100">
                                                    <h1>' . $project->title . '</h1>
                                                    <div class="Languages">
                                                        ' . implode('', array_map(function ($language) {
                        return '<p>' . $language . '</p>';
                    }, $project->programming_languages)) . '
                                                    </div>
                                                    <p>' . $project->text . '</p>
                                                </div>
                                                <button>Meer over project...</button>
                                            </div>
                                            <div class="col">
                                                <img src="' . asset('images/' . $afbeelding) . '" alt="Project Image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ';
            })->implode('') . '
                    </div>
                    <div class="projectBallen" id="blobs">
                    <div class="blob-line"></div>
                    <div class="blob-light"></div>
                        ' . collect(range(0, $ballen))->map(function ($i) {
                return '

                                <button class="blob ' . ($i == 0 ? 'active' : '') . '"
                                    onclick="changeProjecten(' . $i . ', \'projectenRijEen\', \'projectenRijTwee\' ,\'blobs\')"></button>
                            ';
            })->implode('') . '
                    </div>
                    <div class="projectenPositie" id="projectenRijTwee">
                        ' . $projectenRijTwee->map(function ($project, $index) {
                $afbeelding = $project->image ?? 'Rectangle.png';
                $activeClass = $index == 1? 'active' : '';
                return '
                                <div class="project ' . $activeClass . '">
                                    <div class="projectTop">
                                        <div class="row space-between">
                                            <div class="col space-between h-100">
                                                <div class="Text justify-between h-100">
                                                    <h1>' . $project->title . '</h1>
                                                    <div class="Languages">
                                                        ' . implode('', array_map(function ($language) {
                        return '<p>' . $language . '</p>';
                    }, $project->programming_languages)) . '
                                                    </div>
                                                    <p>' . $project->text . '</p>
                                                </div>
                                                <button>Meer over project...</button>
                                            </div>
                                            <div class="col">
                                                <img src="' . asset('images/' . $afbeelding) . '" alt="Project Image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ';
            })->implode('') . '
                    </div>
                </div>
            </div>
        ';
    }
}
