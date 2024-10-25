<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Role;
use App\Models\Permission;

class AssignPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::where('slug', 'admin')->first();
        $admin->permissions()->attach(Permission::where('slug', 'ver-usuarios')->first());
        $admin->permissions()->attach(Permission::where('slug', 'crear-usuarios')->first());
        $admin->permissions()->attach(Permission::where('slug', 'editar-usuarios')->first());
        $admin->permissions()->attach(Permission::where('slug', 'ver-tareas')->first());
        $admin->permissions()->attach(Permission::where('slug', 'editar-tareas')->first());
        $admin->permissions()->attach(Permission::where('slug', 'crear-tareas')->first());
        $admin->permissions()->attach(Permission::where('slug', 'eliminar-tareas')->first());

        $gerente = Role::where('slug', 'gerente')->first();
        $gerente->permissions()->attach(Permission::where('slug', 'ver-usuarios')->first());
        $gerente->permissions()->attach(Permission::where('slug', 'ver-tareas')->first());
        $gerente->permissions()->attach(Permission::where('slug', 'editar-tareas')->first());
        $gerente->permissions()->attach(Permission::where('slug', 'crear-tareas')->first());
        $gerente->permissions()->attach(Permission::where('slug', 'eliminar-tareas')->first());

        $superadmin = Role::where('slug', 'superadmin')->first();
        $superadmin->permissions()->attach(Permission::where('slug', 'all')->first());

        $operario = Role::where('slug', 'operario')->first();
        $operario->permissions()->attach(Permission::where('slug', 'ver-tareas')->first());
        $operario->permissions()->attach(Permission::where('slug', 'editar-tareas')->first());

    }
}