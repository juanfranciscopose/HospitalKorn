<?php

use Illuminate\Database\Seeder;

class TableAttentionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attentions')->insert([
            'patient_id' => 1,
            'diagnostic' => 'tumor',
            'date' => date("Y-m-d")
        ]);
        DB::table('attentions')->insert([
            'patient_id' => 1,
            'diagnostic' => 'pelvis',
            'date' => date("Y-m-d")
        ]);
        DB::table('attentions')->insert([
            'patient_id' => 2,
            'diagnostic' => 'cancer',
            'date' => date("Y-m-d")
        ]);
    }
}
