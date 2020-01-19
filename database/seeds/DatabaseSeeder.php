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
            'attentions',
            'model_has_permissions',
            'model_has_roles',
            'permissions',
            'roles',
            'role_has_permissions',
            'configurations',
            'institutions',
            'patientsNN'
        ]);
        $this->call(tablePatientsNNSeeder::class);
        $this->call(TableUsersSeeder::class);
        $this->call(TablePatientsSeeder::class);
        $this->call(TableAttentionsSeeder::class);
        $this->call(TablesPermissionSeeder::class);
        $this->call(TableConfigurationsSeeder::class);
        $this->call(TableInstitutionsSeeder::class);

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
