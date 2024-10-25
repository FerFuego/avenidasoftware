<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use PhpParser\Node\Expr\Assign;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AssignRolesSeeder::class);
        $this->call(AssignPermissionsSeeder::class);
    }
}
