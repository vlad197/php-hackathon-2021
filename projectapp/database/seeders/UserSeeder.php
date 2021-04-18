<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\App\Models\User::count()) {
            return;
        }
        $user = new \App\Models\User();
        $user->name = "admin1";
        $user->email = "admin1@mail.com";
        $user->password = "12345678";
        $user->save();

        $user = new \App\Models\User();
        $user->name = "admin2";
        $user->email = "admin2@mail.com";
        $user->password = "12345678";
        $user->save();


        $user = new \App\Models\User();
        $user->name = "admin3";
        $user->email = "admin3@mail.com";
        $user->password = "12345678";
        $user->save();


        $user = new \App\Models\User();
        $user->name = "admin4";
        $user->email = "admin4@mail.com";
        $user->password = "12345678";
        $user->save();

    }
}
