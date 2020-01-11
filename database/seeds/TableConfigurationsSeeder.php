<?php

use Illuminate\Database\Seeder;

class TableConfigurationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configurations')->insert([
            'name' => 'title_nav',
            'value' => 'Hospital Dr Korn',
            'description' => 'Es el titulo que se encuentra en la parte superior del navegador'
        ]);
        DB::table('configurations')->insert([
            'name' => 'title_system',
            'value' => 'Sistema Hospital',
            'description' => 'Es el titulo que se encuentra en la solapa del navegador'
        ]);
        DB::table('configurations')->insert([
            'name' => 'email',
            'value' => 'HospAlejandroKorn@gmail.com',
            'description' => 'Es el correo electronico institucional que aparecera en la parte inferior del navegador'
        ]);
        DB::table('configurations')->insert([
            'name' => 'description',
            'value' => '520 y 175 Melchor Romero',
            'description' => 'Descripción general que aparecera en la parte inferior del navegador'
        ]);
        DB::table('configurations')->insert([
            'name' => 'pagination',
            'value' => '10',
            'description' => 'Es la cantidad de elementos por pagina que apareceran en las listas'
        ]);
        DB::table('configurations')->insert([
            'name' => 'enable',
            'value' => '1',
            'description' => 'Si el sistema se encuentra habilitado esta en 1, caso contrario en cero'
        ]);
    }
}
