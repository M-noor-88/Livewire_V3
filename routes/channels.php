<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


Broadcast::channel('private-chat.{fromUserId}.{toUserId}', function ($user, $fromUserId, $toUserId) {
    return (int) $user->id === (int) $fromUserId || (int) $user->id === (int) $toUserId;
});

//Broadcast::private('chat.{fromUserId}.{toUserId}');
