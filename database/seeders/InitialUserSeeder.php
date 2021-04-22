<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InitialUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // CREAR USUARIO INICIAL PARA EL SISTEMA APP USERS
        \DB::table('users')->insert(array (
                0 => array ( 'name' => 'Yamil Roger Alejo Perez', 'email' => 'knt_277@hotmail.es', 'password' => Hash::make('gus[][]@G123'), 'phone_number' => 4444, 'identity_card' => 8580227, 'date_birth' => '1989-04-27', 'city' => 'Llallagua'),
            )
        );
    }
}
