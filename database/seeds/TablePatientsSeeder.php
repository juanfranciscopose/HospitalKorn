<?php

use Illuminate\Database\Seeder;

class TablePatientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patients')->insert([
            'name' => 'dieguito',
            'surname' => 'santili',
            'clinical_history_number' => 1
        ]);
        DB::table('patients')->insert([
            'name' => 'colo',
            'surname' => 'Mac alister',
            'clinical_history_number' => 2
        ]);
        DB::table('patients')->insert([
            'name' => 'ferchu',
            'surname' => 'niembro',
            'clinical_history_number' => 3
        ]);
        DB::table('patients')->insert([
            'name' => 'gaby',
            'surname' => 'michetti',
            'clinical_history_number' => 4
        ]);
        DB::table('patients')->insert([
            'name' => 'pelado',
            'surname' => 'larreta',
            'clinical_history_number' => 5
        ]);
    }
}
