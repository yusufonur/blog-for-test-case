<?php

namespace Database\Seeders;

use Api\V1\Articles\Models\Article;
use Api\V1\Users\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRoleName = config("role.admin");
        $writerRoleName = config("role.writer");

        User::query()
            ->create([
                "name" => "Yusuf Onur SARI",
                "email" => "63yusufsari63@gmail.com",
                "password" => Hash::make("123")
            ])
            ->assignRole($adminRoleName);

        $this->createUser(1, $adminRoleName);

        $this->createUser(10, $writerRoleName);
    }

    private function createUser($count = 1, $roleName = null)
    {
        $users = User::factory($count)
            ->create();

        if ($roleName) {
            $users->each(function ($user) use ($roleName) {
                $user->assignRole($roleName);
            });
        }

        return $users;
    }
}
