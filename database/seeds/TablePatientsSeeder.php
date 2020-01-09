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
        factory(App\Patient::class, 500)->create(); 
        /*
        DB::table('patients')->insert([
            'name' => 'dieguito',
            'surname' => 'santili',
            'clinical_history_number' => 1,
            'birthdate' => date("Y-m-d"),
            'party' => 1,
            'town' => 1,
            'address' => 'la croce y peron',
            'gender' => 'MASCULINO',
            'document_type' => 1,
            'document_number' => 4343,
            'folder_number' => 3,
            'telephone' => '11-2434543',
            'social_work' => 1
        ]);
        DB::table('patients')->insert([
            'name' => 'colo',
            'surname' => 'Mac alister',
            'clinical_history_number' => 2,
            'birthdate' => date("Y-m-d"),
            'party' => 3,
            'town' => 2,
            'address' => 'evita y peron',
            'gender' => 'MASCULINO',
            'document_type' => 1,
            'document_number' => 76576,
            'folder_number' => 2,
            'telephone' => '11-5435433',
            'social_work' => 2
        ]);
        DB::table('patients')->insert([
            'name' => 'ferchu',
            'surname' => 'niembro',
            'clinical_history_number' => 3,
            'birthdate' => date("Y-m-d"),
            'party' => 4,
            'town' => 2,
            'address' => 'derqui y mitre',
            'gender' => 'MASCULINO',
            'document_type' => 1,
            'document_number' => 6533,
            'folder_number' => 5,
            'telephone' => '11-764433',
            'social_work' => 4
        ]);
        DB::table('patients')->insert([
            'name' => 'gaby',
            'surname' => 'michetti',
            'clinical_history_number' => 4,
            'birthdate' => date("Y-m-d"),
            'party' => 1,
            'town' => 1,
            'address' => 'la croce y peron',
            'gender' => 'FEMENINO',
            'document_type' => 1,
            'document_number' => 5454,
            'folder_number' => 3,
            'telephone' => '11-2434543',
            'social_work' => 1
        ]);
        DB::table('patients')->insert([
            'name' => 'pelado',
            'surname' => 'larreta',
            'clinical_history_number' => 5,
            'birthdate' => date("Y-m-d"),
            'party' => 1,
            'town' => 1,
            'address' => 'la croce y peron',
            'gender' => 'MASCULINO',
            'document_type' => 1,
            'document_number' => 6666,
            'folder_number' => 3,
            'telephone' => '11-2434543',
            'social_work' => 1
        ]);*/
    }
}
