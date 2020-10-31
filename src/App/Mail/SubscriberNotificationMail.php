<?php

namespace App\Mail;

use Api\V1\Articles\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriberNotificationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var Article
     */
    public Article $article;
    public string $name;

    /**
     * Create a new message instance.
     *
     * @param Article $article
     * @param string $name
     */
    public function __construct(Article $article, string $name)
    {
        //
        $this->article = $article;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.subscriberMailNotification');
    }
}
