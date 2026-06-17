<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Program;
use App\Models\Trainer;

class PageController extends Controller
{
    public function home()
    {
        return view('home', [
            'programs' => Program::all(),
            'trainers' => Trainer::all(),
            'plans' => Plan::all(),
        ]);
    }

}
