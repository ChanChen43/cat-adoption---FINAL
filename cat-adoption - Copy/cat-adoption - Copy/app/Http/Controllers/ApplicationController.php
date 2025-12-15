<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;

class ApplicationController extends Controller
{
    // Show the user's applications
    public function index()
    {
        $applications = Application::where('user_id', Auth::id())->with('cat')->get();
        return view('applications.index', compact('applications'));
    }
// Show the adoption application form for a specific cat
public function create($catId)
{
    $cat = \App\Models\Cat::find($catId); // fetch from database

    if (!$cat) {
        abort(404);
    }

    return view('applications.create', compact('cat'));
}

    // Store the adoption application
    public function store(Request $request, $catId)
    {
        $validatedData = $request->validate([
            'salary' => 'required|numeric',
            'payment_status' => 'required|in:1,0',
            'status' => 'required|string',
        ]);

        $application = new Application();
        $application->user_id = Auth::id();
        $application->cat_id = $catId;
        $application->fill($validatedData);
        $application->status = $this->determineStatus($application->salary);

        if ($application->status === 'approved') {
            $cat = $application->cat;
            $cat->available = 0; // Mark the cat as unavailable
            $cat->save();
        }

        $application->save();

        return redirect()->route('applications.index');
    }

    private function determineStatus($salary)
    {
        // Simple logic: approve if salary > 35000, decline if < 15000, else pending
        if ($salary > 35000) {
            return 'approved';
        } elseif ($salary < 15000) {
            return 'declined';
        }

        return 'pending';
    }
}
