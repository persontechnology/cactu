<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class PermisosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::updateOrCreate(['name' => 'G. de usuarios']);
        Permission::updateOrCreate(['name' => 'G. de coordinadores']);
        Permission::updateOrCreate(['name' => 'G. de gestores']);
        Permission::updateOrCreate(['name' => 'G. de participantes']);
        Permission::updateOrCreate(['name' => 'G. de niños']);
        Permission::updateOrCreate(['name' => 'G. de modelo programáticos']);
        Permission::updateOrCreate(['name' => 'G. de modelo']);
        Permission::updateOrCreate(['name' => 'G. de actividades']);
        Permission::updateOrCreate(['name' => 'G. de comunidades']);
        Permission::updateOrCreate(['name' => 'G. de tipo de participantes']);
        Permission::updateOrCreate(['name' => 'G. de cuentas contables']);
        Permission::updateOrCreate(['name' => 'G. de planificaciones']);
        Permission::updateOrCreate(['name' => 'Registro de asistencia a actividades']);
        Permission::updateOrCreate(['name' => 'G.de materiales']);
        Permission::updateOrCreate(['name' => 'G. de acta entrega recepción']);
        Permission::updateOrCreate(['name' => 'G. de archivos']);
        $role=Role::findByName('Administrador');
        $role->syncPermissions(Permission::all());

        

    }
}
