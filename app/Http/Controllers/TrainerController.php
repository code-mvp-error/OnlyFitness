<?php

namespace App\Http\Controllers;

use App\Models\Trainer;

class TrainerController extends Controller
{
    public function index()
    {
        $trainers = Trainer::all();

        return view('trainers', compact('trainers'));
    }
}
