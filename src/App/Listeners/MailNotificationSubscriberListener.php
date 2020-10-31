<?php

namespace App\Listeners;

use Api\V1\Subscribers\Models\Subscriber;
use App\Events\CreateArticleEvent;
use App\Jobs\SubscriberNotificationJob;
use App\Mail\SubscriberNotificationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class MailNotificationSubscriberListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  CreateArticleEvent  $event
     * @return void
     */
    public function handle(CreateArticleEvent $event)
    {
        $subscribers = Subscriber::all();

        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)
                ->queue(new SubscriberNotificationMail($event->article, $subscriber->name));
//            new SubscriberNotificationJob($event->article, $subscriber->email, $subscriber->name);
        }
    }
}
