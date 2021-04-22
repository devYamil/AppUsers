<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // EJECUTAR SEEDER PARA CITIES
        \DB::table('cities')->insert(array (
                0 => array ( 'id_state' => 1, 'name_city' => 'Guayaramerin'),
                1 => array ( 'id_state' => 1, 'name_city' => 'Riveralta'),
                2 => array ( 'id_state' => 2, 'name_city' => 'Camargo'),
                3 => array ( 'id_state' => 2, 'name_city' => 'Monteagudo'),
                4 => array ( 'id_state' => 3, 'name_city' => 'Tiquipaya'),
                5 => array ( 'id_state' => 3, 'name_city' => 'Sacaba'),
                6 => array ( 'id_state' => 4, 'name_city' => 'Achacachi'),
                7 => array ( 'id_state' => 4, 'name_city' => 'Caranavi'),
                8 => array ( 'id_state' => 5, 'name_city' => 'Challapata'),
                9 => array ( 'id_state' => 5, 'name_city' => 'Huanuni'),
                10 => array ( 'id_state' => 6, 'name_city' => 'Cobija'),
                11 => array ( 'id_state' => 6, 'name_city' => 'Madre de Dios'),
                12 => array ( 'id_state' => 7, 'name_city' => 'Llallagua'),
                13 => array ( 'id_state' => 7, 'name_city' => 'Uyuni'),
                14 => array ( 'id_state' => 8, 'name_city' => 'Camiri'),
                15 => array ( 'id_state' => 8, 'name_city' => 'Cotoca'),
                16 => array ( 'id_state' => 9, 'name_city' => 'Bermejo'),
                17 => array ( 'id_state' => 9, 'name_city' => 'Yacuiba'),
                18 => array ( 'id_state' => 10, 'name_city' => 'El Encanto'),
                19 => array ( 'id_state' => 10, 'name_city' => 'La Victoria'),
                20 => array ( 'id_state' => 11, 'name_city' => 'Abejorral'),
                21 => array ( 'id_state' => 11, 'name_city' => 'Andes'),
            )
        );
    }
}
