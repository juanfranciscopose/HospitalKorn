<?php

use Illuminate\Database\Seeder;

class TableInstitutionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('institutions')->insert([
            'name' => 'HIGA San Martin',
            'director' => 'Campos Maria',
            'telephone' => '221-5567543',
            'address' => '1 e/70 y 71',
            'lat' => '-34.92286',
            'long' => '-57.92299',
            'sanitary_region_id' => 9,
        ]);
        DB::table('institutions')->insert([
            'name' => 'HIGA Rossi',
            'director' => 'Hernesto De La Cruz',
            'telephone' => '221-122334',
            'address' => '39 y 116',
            'lat' => '-34.89703',
            'long' => '-57.95507',
            'sanitary_region_id' => 9,
        ]);
        DB::table('institutions')->insert([
            'name' => 'Hospital municipal',
            'director' => 'Butera Blas',
            'telephone' => '221-5567543',
            'address' => 'Di Claudio y Pose',
            'lat' => '-34.91177',
            'long' => '-60.03693',
            'sanitary_region_id' => 10,
        ]);
    }
}
