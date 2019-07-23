<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
            'users',
            'patients',
            'attentions'
        ]);
        $this->call(TableUsersSeeder::class);
        $this->call(TablePatientsSeeder::class);
        $this->call(TableAttentionsSeeder::class);
    }
    protected function truncateTables(array $tables)
    {
        Schema::disableForeignKeyConstraints();//turn off foreing key
        foreach ($tables as $table){
            DB::table($table)->truncate();
        }
        Schema::enableForeignKeyConstraints(); //turn on foreing key
    }
}
