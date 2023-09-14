<?php

namespace App\Livewire;

use App\Models\Notification;
use Livewire\Component;

class Navbar extends Component
{
    // Unread notifications property
    public $unreadNotifications;

    public function mount()
    {
        if (auth()->check()) {
            $this->unreadNotifications = Notification::where('user_id', auth()->user()->id)
                ->where('read', false)
                ->orderByDesc('created_at')
                ->get();
        }
    }

    public function render()
    {
        return view('livewire.navbar');
    }
}
