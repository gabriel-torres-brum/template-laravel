<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public string $user;

    public function mount()
    {
        $user = User::find(auth()->user()->id)->loadMissing('member');
        $this->user = $user->member->name;
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
