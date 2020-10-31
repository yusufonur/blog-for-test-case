<?php

namespace App\Listeners;

use App\Events\CreateArticleEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MailNotificationSubscriberListener
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
     * @param  CreateArticleEvent  $event
     * @return void
     */
    public function handle(CreateArticleEvent $event)
    {
        //
    }
}
