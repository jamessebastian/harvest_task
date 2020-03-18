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

         $this->call(OrganisationsTableSeeder::class);
         $this->call(RolesTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(ClientsTableSeeder::class);
         $this->call(TasksTableSeeder::class);
         $this->call(AbilityTableSeeder::class);

         factory(App\Clients::class,35)->create();
         factory(App\Tasks::class,35)->create();
    }
}
