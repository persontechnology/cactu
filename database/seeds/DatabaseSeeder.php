<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // enviar datos de inicio a base de datos
        $this->call(RolesTableSeeder::class);
        $this->call(PermisosTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        // localidades
        $this->call(ProvinciasTableSeeder::class);
        $this->call(CantonesTableSeeder::class);
        $this->call(ComunidadesTableSeeder::class);
        //tipo de participante
        $this->call(TipoParticipanteTableSeeder::class);
        // tipo deactividad
        $this->call(TipoActividadTableSeeder::class);
        // mese
        $this->call(MesSeederTable::class);
        //cuentas contables
        
        $this->call(CuentasContablesTableSeeder::class);
        
    }
}
