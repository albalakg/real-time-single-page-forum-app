<?php


Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('likeChannel', function () {
    return true;
});

Broadcast::channel('replyChannel', function () {
    return true;
});

Broadcast::channel('deleteReplyChannel', function () {
    return true;
});
