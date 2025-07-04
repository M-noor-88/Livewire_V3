<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatWrapper extends Component
{
    public $users;
    public $selectedUserId = null;

    public function mount()
    {
        $this->users = User::where('id', '!=', Auth::id())->get();
    }

    public function selectUser($userId)
    {
        $this->selectedUserId = $userId;
    }



    public function render()
    {
        return view('livewire.chat-wrapper')->layout('layouts.app'); // unified layout
    }
}
