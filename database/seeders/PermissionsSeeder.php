<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('permissions')->insert([
            [
                'id' => 1,
                'name' => 'all',
                'slug' => 'all',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'ver tareas',
                'slug' => 'ver-tareas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'editar tareas',
                'slug' => 'editar-tareas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'crear tareas',
                'slug' => 'crear-tareas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'eliminar tareas',
                'slug' => 'eliminar-tareas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'crear usuarios',
                'slug' => 'crear-usuarios',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'name' => 'editar usuarios',
                'slug' => 'editar-usuarios',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'name' => 'eliminar usuarios',
                'slug' => 'eliminar-usuarios',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'name' => 'ver usuarios',
                'slug' => 'ver-usuarios',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
