<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // EJECUTAR SEEDER PARA COUNTRIES
        \DB::table('countries')->insert(array (
                0 => array ( 'id' => 1, 'name_country' => 'Bolivia'),
                1 => array ( 'id' => 2, 'name_country' => 'Colombia'),
            )
        );
    }
}
