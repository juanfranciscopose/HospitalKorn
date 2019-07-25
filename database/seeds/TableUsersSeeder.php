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
            'email' => 'jhondoe@gmail.com',
            'password' => bcrypt('asd'),
            'active' => 1
        ]);
        DB::table('users')->insert([
            'email' => 'asd@gmail.com',
            'password' => bcrypt('asd'),
            'active' => 0
        ]);
    }
}
