<?php

namespace App\Livewire;

use App\Events\MessageSent;
use App\Events\UserTyping;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Chat extends Component
{
    public array $messages = [];
    public string $message = '';
    public $receiverId;

   // protected $listeners = ['echo-private:chat.' . '{fromUserId}.' . '{toUserId},MessageSent' => 'messageReceived'];

    public function mount($receiverId): void
    {
        $this->receiverId = $receiverId;

        Log::info("revicer" . $receiverId);

        // Load existing messages between auth user and receiver
        $this->messages = Message::where(function ($q) {
            $q->where('from_user_id', Auth::id())->where('to_user_id', $this->receiverId);
        })->orWhere(function ($q) {
            $q->where('from_user_id', $this->receiverId)->where('to_user_id', Auth::id());
        })->orderBy('created_at')->get()->toArray();

    }

    public function sendMessage(): void
    {
        $this->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'from_user_id' => Auth::id(),
            'to_user_id' => $this->receiverId,
            'message' => $this->message,
        ]);

        // Broadcast event
        Broadcast(new MessageSent($message))->toOthers();
        Log::info('Message sent in Livewire: ' . $message);

        $this->messages[] = $message->toArray();
        $this->message = '';
    }

    public bool $isTyping = false;
    public function typing(): void
    {
        Log::info("Typing !!");
        broadcast(new UserTyping(Auth::id(), $this->receiverId))->toOthers();
    }





    public function showTyping($data): void
    {
        Log::info("Show Typing Functioon");
        $this->isTyping = true;
    }


    public function resetTyping()
    {
        $this->isTyping = false;

    }


    public function getListeners(): array
    {
        $fromId = auth()->id();
        $toId = $this->receiverId;
        return [
            "echo-private:private-chat.{$fromId}.{$toId},.message-sent" => 'messageReceived',
            "echo-private:private-chat.{$toId}.{$fromId},.user-typing" => 'showTyping',
            "echo-private:private-chat.{$fromId}.{$toId},.user-typing" => 'showTyping',

        ];

    }
    public function messageReceived($payload): void
    {
        if ((int)$payload['from_user_id'] === Auth::id()) {
            return;
        }
        Log::info('Message REEEEECC in Livewire: ' , (array) $payload);
        $this->messages[] = $payload;

    }
    public function render()
    {
        return view('livewire.chat');
    }
}
