<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Get all permissions
        $permissions = \App\Models\Permission::all();

        //Give all permissions to God Mode role
        $godModePermissions = [];
        foreach ($permissions as $permission) {
            $godModePermissions[$permission->name] = 1;
        }

        //Save role for God Mode
        $roleGodMode = [
            'name' => 'God Mode',
            'slug' => 'god-mode',
            'permissions' => $godModePermissions
        ];
        Sentinel::getRoleRepository()->createModel()->fill($roleGodMode)->save();
        
    }
}
