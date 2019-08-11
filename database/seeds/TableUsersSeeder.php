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
        DB::table('users')->insert([
            'email' => 'root@root.com',
            'password' => bcrypt('root'),
            'active' => 1,
            'name' => 'root',
            'surname' => 'root'
        ]);
        DB::table('users')->insert([
            'email' => 'jhondoe@gmail.com',
            'password' => bcrypt('asd'),
            'active' => 1,
            'name' => 'Jhon',
            'surname' => 'Doe'
        ]);
        DB::table('users')->insert([
            'email' => 'carla@gmail.com',
            'password' => bcrypt('asd'),
            'active' => 0,
            'name' => 'Carla',
            'surname' => 'Garesi'
        ]);
        DB::table('users')->insert([
            'email' => 'seba@gmail.com',
            'password' => bcrypt('asd'),
            'active' => 1,
            'name' => 'Sebastian',
            'surname' => 'Pose'
        ]);
    }
}
