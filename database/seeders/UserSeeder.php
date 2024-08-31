<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@test.com';
        $user->email_verified_at = now();
        $user->password = \Illuminate\Support\Facades\Hash::make('secret');
        //$user->id_user_type = 1;
        $user->status = '1';
        $user->save();

        $user = new User();        
        $user->name = 'User';
        $user->email = 'user@test.com';
        $user->email_verified_at = now();
        $user->password = \Illuminate\Support\Facades\Hash::make('secret');
        //$user->id_user_type = 2;
        $user->status = '1';
        $user->save();
    }
}
