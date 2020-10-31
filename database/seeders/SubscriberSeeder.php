<?php

namespace Database\Seeders;

use Api\V1\Subscribers\Models\Subscriber;
use Illuminate\Database\Seeder;

class SubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subscriber::factory(10)
            ->create();
    }
}
