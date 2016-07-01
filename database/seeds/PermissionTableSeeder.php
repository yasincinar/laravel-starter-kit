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
            ['display_name' => 'Admin Platform Görüntüle', 'name' => 'admin.show'],
            //User
            ['display_name' => 'Kullanıcı Görüntüleme', 'name' => 'user.show'],
            ['display_name' => 'Kullanıcı Oluşturma', 'name' => 'user.create'],
            ['display_name' => 'Kullanıcı Düzenleme', 'name' => 'user.edit'],
            ['display_name' => 'Kullanıcı Silme', 'name' => 'user.delete'],
            //Group
            ['display_name' => 'Kullanıcı Grubu Görüntüleme', 'name' => 'group.show'],
            ['display_name' => 'Kullanıcı Grubu Oluşturma', 'name' => 'group.create'],
            ['display_name' => 'Kullanıcı Grubu Düzenleme', 'name' => 'group.edit'],
            ['display_name' => 'Kullanıcı Grubu Silme', 'name' => 'group.delete'],
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
