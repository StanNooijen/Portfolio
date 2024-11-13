<?php

// app/Http/Controllers/Controller.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HardSkill;
use App\Models\SoftSkill;

class Controller
{
    public function getData()
    {
        $hardskills = HardSkill::all();
        $softskills = SoftSkill::all();
        return view('welcome', ['hardskills' => $hardskills, 'softskills' => $softskills]);
    }
}
