<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ins = factory(LearningWords\institucion::class)->create([
	        'nombre' => 'Ceindetec',
	        'nit' => '123456789',
	        'cantidad_licencias' => 100
	    ]);

        factory(LearningWords\User::class)->create([
	        'nombres' => 'Ceindetec',
	        'apellidos' => 'Superadmin',
	        'documento' => '86071518',
	        'password' => 'Secreto',
	        'remember_token' => str_random(10),
	        'rol' => 'superadmin',
	        'institucion_id' => $ins->id
	    ]);
    }
}
