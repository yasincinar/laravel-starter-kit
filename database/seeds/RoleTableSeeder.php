<?php

use App\Models\Role;
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
            $godModePermissions[$permission->name] = true;
        }

        //Save role for God Mode
        Role::create([
            'name' => 'God Mode',
            'slug' => 'god-mode',
            'permissions' => $godModePermissions
        ]);
        
    }
}
