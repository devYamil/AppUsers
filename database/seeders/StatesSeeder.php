<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // EJECUTAR SEEDER PARA STATES
        \DB::table('states')->insert(array (
                0 => array ( 'id' => 1, 'id_country' => 1, 'name_state' => 'Beni'),
                1 => array ( 'id' => 2, 'id_country' => 1, 'name_state' => 'Chuquisaca'),
                2 => array ( 'id' => 3, 'id_country' => 1, 'name_state' => 'Cochabamba'),
                3 => array ( 'id' => 4, 'id_country' => 1, 'name_state' => 'La Paz'),
                4 => array ( 'id' => 5, 'id_country' => 1, 'name_state' => 'Oruro'),
                5 => array ( 'id' => 6, 'id_country' => 1, 'name_state' => 'Pando'),
                6 => array ( 'id' => 7, 'id_country' => 1, 'name_state' => 'Potosi'),
                7 => array ( 'id' => 8, 'id_country' => 1, 'name_state' => 'Santa Cruz'),
                8 => array ( 'id' => 9, 'id_country' => 1, 'name_state' => 'Tarija'),
                9 => array ( 'id' => 10, 'id_country' => 2, 'name_state' => 'Amazonas'),
                10 => array ( 'id' => 11, 'id_country' => 2, 'name_state' => 'Antioquia'),
            )
        );
    }
}
