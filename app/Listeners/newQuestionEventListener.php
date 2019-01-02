<?php

namespace App\Listeners;

use App\Events\newQuestionEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class newQuestionEventListener
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
     * @param  newQuestionEvent  $event
     * @return void
     */
    public function handle(newQuestionEvent $event)
    {
        //
    }
}
