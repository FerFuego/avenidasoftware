<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'Superadmin',
            'email' => 'secret@secret.com',
            'password' => '$2y$10$/c5ZrHu5KCdyEBePZEcjae9SqO8eylz5R5MlLV5HUSeqmcBgrU4Hq',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@test.com',
            'password' => \Illuminate\Support\Facades\Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Fer Catalano',
            'email' => 'ferc_vcp@hotmail.com',
            'password' => '$2y$10$t/6DxA2CQwyO0DwqXxK4ZeaDrjFG9h1tEvvF9OvKPA58.Fijh1r.i',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Gerente',
            'email' => 'gerente@secret.com',
            'password' => \Illuminate\Support\Facades\Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Operario',
            'email' => 'operario@secret.com',
            'password' => \Illuminate\Support\Facades\Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@secret.com',
            'password' => \Illuminate\Support\Facades\Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
