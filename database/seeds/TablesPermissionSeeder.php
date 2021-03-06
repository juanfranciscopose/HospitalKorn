<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class TablesPermissionSeeder extends Seeder
{
    /**
     * 
     *index -> lista
     *new -> crear
     *destroy -> borrar
     *update -> editar
     *show -> mostrar detalles de uno
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'GuardTeam']);
        Role::create(['name' => 'Admin']);

        Permission::create(['name' => 'patient_index']);
        Permission::create(['name' => 'patient_new']);
        Permission::create(['name' => 'patient_destroy']);
        Permission::create(['name' => 'patient_update']);
        Permission::create(['name' => 'patient_show']);

        Permission::create(['name' => 'config_index']);
        Permission::create(['name' => 'config_update']);

        Permission::create(['name' => 'report_index']);

        Permission::create(['name' => 'attention_index']);
        Permission::create(['name' => 'attention_new']);
        Permission::create(['name' => 'attention_destroy']);
        Permission::create(['name' => 'attention_update']);
        Permission::create(['name' => 'attention_show']);

        Permission::create(['name' => 'user_index']);
        Permission::create(['name' => 'user_new']);
        Permission::create(['name' => 'user_destroy']);
        Permission::create(['name' => 'user_update']);
        Permission::create(['name' => 'user_show']);

        $role = Role::findByName('Admin');
        $role->givePermissionTo(Permission::all());
        $role->revokePermissionTo('patient_new');
        $role->revokePermissionTo('attention_new');

        $role = Role::findByName('GuardTeam');
        $role->givePermissionTo(Permission::findByName('patient_index'));
        $role->givePermissionTo(Permission::findByName('patient_show'));
        $role->givePermissionTo(Permission::findByName('patient_update'));
        $role->givePermissionTo(Permission::findByName('patient_new'));

        $role->givePermissionTo(Permission::findByName('attention_index'));
        $role->givePermissionTo(Permission::findByName('attention_show'));
        $role->givePermissionTo(Permission::findByName('attention_update'));
        $role->givePermissionTo(Permission::findByName('attention_new'));

        $role->givePermissionTo(Permission::findByName('report_index'));

        $user = User::find(41);//root
        $user->assignRole('Admin');
        $user = User::find(42);//root
        $user->assignRole('GuardTeam');

        for ($i=1; $i <= 40; $i++) { 
            $user = User::find($i);//root
            $user->assignRole('GuardTeam');
        }
        
        /*$user = User::find(2);//jhondoe
        $user->assignRole('Admin');

        $user = User::find(3);//carla
        $user->assignRole('GuardTeam');

        $user = User::find(4);//seba
        $user->assignRole('GuardTeam');*/
    }
}
