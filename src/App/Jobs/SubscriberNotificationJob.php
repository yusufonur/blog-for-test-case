<?php

namespace App\Jobs;

use Api\V1\Articles\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SubscriberMailNotificationNewArticle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public int $tries = 5;

    public int $timeout = 15;

    public int $retryAfter = 60;

    public bool $deleteWhenMissingModels = true;


    /**
     * @var Article
     */
    private Article $article;
    private string $email;
    private string $name;

    /**
     * Create a new job instance.
     *
     * @param Article $article
     * @param string $email
     * @param string $name
     */
    public function __construct(Article $article, string $email, string $name)
    {
        $this->article = $article;
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
    }
}
