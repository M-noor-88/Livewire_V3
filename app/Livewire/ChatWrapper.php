<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatWrapper extends Component
{
    public $users;
    public $selectedUserId = null;

    public function mount()
    {
//        $this->users = User::where('id', '!=', Auth::id())->get();
        $authId = auth()->id();

        $this->users = User::where('id', '!=', $authId)
            ->get()
            ->map(function ($user) use ($authId) {
                $lastMessage = $user->lastMessageWith($authId);
                $user->lastMessageText = $lastMessage ? $lastMessage->message : 'Click to chat';
                $user->lastMessageTime = $lastMessage ? $lastMessage->created_at->diffForHumans() : '';

                return $user;
            });
    }

    public function selectUser($userId)
    {
        $this->selectedUserId = $userId;
        $this->loadUsers(); // Reload to refresh last messages

    }

    public function loadUsers()
    {
        $authId = auth()->id();

        $this->users = User::where('id', '!=', $authId)
            ->get()
            ->map(function ($user) use ($authId) {
                $lastMessage = $user->lastMessageWith($authId);
                $user->lastMessageText = $lastMessage ? $lastMessage->message : 'Click to chat';
                $user->lastMessageTime = $lastMessage ? $lastMessage->created_at->diffForHumans() : '';
                return $user;
            });
    }


    public function render()
    {
        return view('livewire.chat-wrapper');
    }
}
