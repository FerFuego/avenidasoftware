<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Illuminate\Permission\Models\Role;
// use Illuminate\Permission\Models\Permission;
// use Illuminate\Support\Facades\DB;


class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $admin = Role::create(['name' => 'admin']);
        // $admin->givePermissionTo(Permission::all());

        // $user = Role::create(['name' => 'user']);
        // $user->givePermissionTo(Permission::all());

        // DB::table('model_has_roles')->insert([
        //     'role_id' => 1,
        //     'model_type' => 'App\Models\User',
        //     'model_id' => 1
        // ]);

        // DB::table('model_has_roles')->insert([
        //     'role_id' => 2,
        //     'model_type' => 'App\Models\User',
        //     'model_id' => 2
        // ]);
    }
}
