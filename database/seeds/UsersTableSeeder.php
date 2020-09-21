<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! User::whereEmail('admin@example.com')->first()) {
            $user = User::create([
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'password' => app('hash')->make('password'),
            ]);
        }
    }
}
