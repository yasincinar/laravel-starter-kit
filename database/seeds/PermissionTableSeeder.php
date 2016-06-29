<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Define permissions
        $permissions = [
            
            //Admin page
            ['display_name' => 'Admin Platform Görüntüle', 'name' => 'admin.show']
        ];

        //Truncate permissions table to avoid already exist error
        DB::table('permissions')->truncate();
        
        //Fill permissions table
        foreach ($permissions as $permission){
            \App\Models\Permission::create([
                'name' => $permission['name'],
                'display_name' => $permission['display_name']
            ]);
        }
    }
}
