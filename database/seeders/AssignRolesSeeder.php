<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Traits\HasSucursals;
use App\Traits\HasRolesAndPermissions;
use App\Models\Role;
use App\Models\Permission;

class AssignRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::where('email', 'secret@secret.com')->first();
        $admin->roles()->attach(Role::where('slug', 'superadmin')->first());
        $admin->permissions()->attach(Permission::where('slug', 'all')->first());

        $user = User::where('email', 'user@test.com')->first();
        $user->roles()->attach(Role::where('slug', 'ver-tareas')->first());

        $superadmin = User::where('email', 'ferc_vcp@hotmail.com')->first();
        $superadmin->roles()->attach(Role::where('slug', 'superadmin')->first());
        $superadmin->permissions()->attach(Permission::where('slug', 'all')->first());

        $admin2 = User::where('email', 'admin@secret.com')->first();
        $admin2->roles()->attach(Role::where('slug', 'admin')->first());
        $admin2->permissions()->attach(Permission::where('slug', 'ver-usuarios')->first());
        $admin2->permissions()->attach(Permission::where('slug', 'crear-usuarios')->first());
        $admin2->permissions()->attach(Permission::where('slug', 'editar-usuarios')->first());
        $admin2->permissions()->attach(Permission::where('slug', 'ver-tareas')->first());
        $admin2->permissions()->attach(Permission::where('slug', 'editar-tareas')->first());
        $admin2->permissions()->attach(Permission::where('slug', 'crear-tareas')->first());
        $admin2->permissions()->attach(Permission::where('slug', 'eliminar-tareas')->first());

        $gerente = User::where('email', 'gerente@secret.com')->first();
        $gerente->roles()->attach(Role::where('slug', 'admin')->first());
        $gerente->permissions()->attach(Permission::where('slug', 'ver-usuarios')->first());
        $gerente->permissions()->attach(Permission::where('slug', 'ver-tareas')->first());
        $gerente->permissions()->attach(Permission::where('slug', 'editar-tareas')->first());
        $gerente->permissions()->attach(Permission::where('slug', 'crear-tareas')->first());
        $gerente->permissions()->attach(Permission::where('slug', 'eliminar-tareas')->first());

        $operario = User::where('email', 'operario@secret.com')->first();
        $operario->roles()->attach(Role::where('slug', 'operario')->first());
        $operario->permissions()->attach(Permission::where('slug', 'ver-tareas')->first());
        $operario->permissions()->attach(Permission::where('slug', 'editar-tareas')->first());

    }
}
