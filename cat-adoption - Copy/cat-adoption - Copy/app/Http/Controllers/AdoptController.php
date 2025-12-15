<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cat;

class AdoptController extends Controller
{
    // Show all cats available for adoption
    public function index()
    {
        $cats = Cat::where('available', 1)->get(); // only available cats
        return view('adopt.index', compact('cats'));
    }

    // Show single cat details
    public function show($id)
    {
        $cat = Cat::findOrFail($id);
        return view('adopt.show', compact('cat'));
    }
}
