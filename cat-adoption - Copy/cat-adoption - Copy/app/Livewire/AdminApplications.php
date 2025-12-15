<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Application;

class AdminApplications extends Component
{
    public $applications;

    public function mount()
    {
        $this->applications = Application::with(['user', 'cat'])->latest()->get();
    }

    public function updateStatus($id, $status)
    {
        $app = Application::findOrFail($id);
        $app->status = $status;
        $app->save();

        // If approved, mark the cat as unavailable
        if ($status === 'approved') {
            $cat = $app->cat;
            if ($cat) {
                $cat->available = 0; // Mark as adopted
                $cat->save();
            }
        }

        $this->applications = Application::with(['user', 'cat'])->latest()->get();
    }

    public function render()
    {
        return view('livewire.admin-applications'); // Blade view
    }
}
