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
        if (! User::whereEmail('info@morbido.ml')->first()) {
            $user = User::create([
                'name' => 'Administrator',
                'email' => 'info@morbido.ml',
                'password' => app('hash')->make('password'),
            ]);
        }
    }
}
