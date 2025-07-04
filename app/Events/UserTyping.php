<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;


class UserTyping implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $fromUserId;
    public $toUserId;

    public function __construct($fromUserId, $toUserId)
    {
        $this->fromUserId = $fromUserId;
        $this->toUserId = $toUserId;
    }

    public function broadcastOn()
    {
        Log::info("Broadcast Typing On");
        return new PrivateChannel("private-chat.{$this->toUserId}.{$this->fromUserId}");
    }

    public function broadcastAs()
    {
        return 'user-typing';
    }

    public function broadcastWith()
    {
        return ['from_user_id' => $this->fromUserId];
    }

}
