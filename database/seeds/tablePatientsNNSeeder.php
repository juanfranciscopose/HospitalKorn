<?php

use Illuminate\Database\Seeder;

class tablePatientsNNSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\PatientNN::class, 10)->create(); 
    }
}
