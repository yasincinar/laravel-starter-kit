<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permission Table Seeder
        $this->call(PermissionTableSeeder::class);
        $this->command->info('Permission table is seeded successfully.');

        //City Table Seeder
        $this->call(CityTableSeeder::class);
        $this->command->info('City table is seeded successfully.');
        
        //Role Table Seeder
        $this->call(RoleTableSeeder::class);
        $this->command->info('Role table is seeded successfully.');

        //User Table Seeder
        $this->call(UserTableSeeder::class);
        $this->command->info('User table is seeded successfully.');
    }
}
