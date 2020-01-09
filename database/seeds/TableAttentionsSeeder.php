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
        factory(App\Attention::class, 1200)->create(); 
        /*DB::table('attentions')->insert([
            'patient_id' => 1,
            'diagnostic' => 'resfrio',
            'date' => date("Y-m-d"),
            'reason' => 'Receta médica',
            'derivation' => null,
            'observation' => null,
            'articulation' => null,
            'internment' => 0,
            'pharmacotherapy' => null,
            'accompaniment' => null
        ]);
        DB::table('attentions')->insert([
            'patient_id' => 1,
            'diagnostic' => 'pelvis',
            'date' => date("Y-m-d"),
            'reason' => 'Control de guardia',
            'derivation' => null,
            'observation' => null,
            'articulation' => null,
            'internment' => 1,
            'pharmacotherapy' => 'Mañana',
            'accompaniment' => 'Familiar cercano'
        ]);
        DB::table('attentions')->insert([
            'patient_id' => 2,
            'diagnostic' => 'cancer',
            'date' => date("Y-m-d"),
            'reason' => 'Control de guardia',
            'derivation' => 1,
            'observation' => 'de colon',
            'articulation' => 'de pelvis',
            'internment' => 1,
            'pharmacotherapy' => null,
            'accompaniment' => 'Hermanos e hijos'
        ]);*/
    }
}
