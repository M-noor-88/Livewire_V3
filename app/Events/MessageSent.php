<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Message $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    // Broadcast on private channel between sender and receiver
    public function broadcastOn()
    {
        Log::info("ON Broadcast");
        return [
            new PrivateChannel('private-chat.' . $this->message->from_user_id . '.' . $this->message->to_user_id),
            new PrivateChannel('private-chat.' . $this->message->to_user_id . '.' . $this->message->from_user_id),
        ];    }

    public function broadcastAS()
    {
        Log::info("AS Broadcast");

        return 'message-sent';
    }
    public function broadcastWith()
    {
        Log::info("With Broadcast");

        Log::info("broadcast with");
        return [
            'id' => $this->message->id,
            'from_user_id' => $this->message->from_user_id,
            'to_user_id' => $this->message->to_user_id,
            'message' => $this->message->message,
            'created_at' => $this->message->created_at->toDateTimeString(),
        ];
    }
}
