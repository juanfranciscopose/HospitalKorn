<?php

use Illuminate\Database\Seeder;

class TableUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 40)->create(); 
        DB::table('users')->insert([
            'email' => 'jhondoe@gmail.com',
            'password' => bcrypt('asd'),
            'active' => 1,
            'name' => 'jhon',
            'surname' => 'doe'
        ]);
        DB::table('users')->insert([
            'email' => 'juan@gmail.com',
            'password' => bcrypt('asd'),
            'active' => 1,
            'name' => 'juan',
            'surname' => 'pose'
        ]);
    }
}
