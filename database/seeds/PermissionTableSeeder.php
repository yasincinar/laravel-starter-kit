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
            ['display_name' => 'Admin Platform Görüntüle', 'name' => 'admin.dashboard'],
            //Users
            ['display_name' => 'Kullanıcı Görüntüleme', 'name' => 'users.show'],
            ['display_name' => 'Kullanıcı Oluşturma', 'name' => 'users.create'],
            ['display_name' => 'Kullanıcı Düzenleme', 'name' => 'users.edit'],
            ['display_name' => 'Kullanıcı Silme', 'name' => 'users.delete'],
            //Groups
            ['display_name' => 'Kullanıcı Grubu Görüntüleme', 'name' => 'groups.show'],
            ['display_name' => 'Kullanıcı Grubu Oluşturma', 'name' => 'groups.create'],
            ['display_name' => 'Kullanıcı Grubu Düzenleme', 'name' => 'groups.edit'],
            ['display_name' => 'Kullanıcı Grubu Silme', 'name' => 'groups.delete'],
        ];

        //Truncate permissions table to avoid already exist error
        DB::table('permissions')->truncate();

        //Fill permissions table
        foreach ($permissions as $permission) {
            \App\Models\Permission::create([
                'name' => $permission['name'],
                'display_name' => $permission['display_name']
            ]);
        }
    }
}
