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
    }
}
