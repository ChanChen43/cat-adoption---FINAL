<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;

class AdminCatController extends Controller
{
    // Show all cats (admin view)
    public function index()
    {
        $cats = Cat::all(); // fetch all cats
        return view('admin.cat.index', compact('cats'));
    }

    // Show form to create a new cat
    public function create()
    {
        return view('admin.cat.create'); // create.blade.php
    }

    // Store new cat in database
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'breed' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048', // optional image
        ]);

        // Create a new cat instance
        $cat = new Cat();
        $cat->name = $request->name;
        $cat->age = $request->age;
        $cat->breed = $request->breed;
        $cat->description = $request->description;
        $cat->available = 1; // default available

        // Handle image upload if provided
       if ($request->hasFile('image')) {
         $path = $request->file('image')->store('cats', 'public'); // stores in storage/app/public/cats
         $cat->image = $path; // e.g., "cats/newcat.jpg"
        }


        $cat->save();

        return redirect()->route('admin.cats.index')
                         ->with('message', 'New cat added successfully!');
    }

    // Toggle cat availability (adopted / available)
    public function updateStatus($id)
    {
        $cat = Cat::findOrFail($id);

        $cat->available = !$cat->available; // toggle
        $cat->save();

        if (!$cat->available) {
            session()->flash('adopted_cat', $cat->name);
        }

        return redirect()->route('admin.cats.index');
    }

    // Show form to edit an existing cat
    public function edit($id)
    {
        $cat = Cat::findOrFail($id);
        return view('admin.cat.create', compact('cat')); // Reuse create view
    }

    // Update an existing cat in the database
    public function update(Request $request, $id)
    {
        $cat = Cat::findOrFail($id);

        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'breed' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // Update cat details
        $cat->name = $request->name;
        $cat->age = $request->age;
        $cat->breed = $request->breed;
        $cat->description = $request->description;

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('cats', 'public');
            $cat->image = $path;
        }

        $cat->save();

        return redirect()->route('admin.cats.index')
                         ->with('message', 'Cat updated successfully!');
    }

    // Delete a cat from the database
    public function destroy($id)
    {
        $cat = Cat::findOrFail($id);
        $cat->delete();

        return redirect()->route('admin.cats.index')
                         ->with('message', 'Cat deleted successfully!');
    }
}
