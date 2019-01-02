<?php

namespace App\Listeners;

use App\Events\ReplyEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReplyEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ReplyEvent  $event
     * @return void
     */
    public function handle(ReplyEvent $event)
    {
        //
    }
}
