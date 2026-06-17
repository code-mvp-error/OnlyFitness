<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Trainer;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::all();
        $trainers = Trainer::all();

        return view('programs', compact('programs', 'trainers'));
    }
}
