<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Register admin with God Mode role
        $admin = [
            'email' => 'admin@admin.com',
            'password' => 'admin',
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'slug' => 'admin',
            'cell_phone' => 11111111111,
            'identity_number' => 11111111111,
            'city_id' => 26
        ];

        $godModeRole = \App\Models\Role::where('slug','god-mode')->first();
        $adminUser = Sentinel::registerAndActivate($admin);
        $adminUser->roles()->attach($godModeRole->id);
    }
}
