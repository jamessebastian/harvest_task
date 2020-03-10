<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Role::truncate();

        Role::create(['name'=>'admin']);
      //  Role::create(['name'=>'pm']);
        Role::create(['name'=>'user']);
    }

}

//
//'view-client'=>false,
//                'create-client'=>false,
//                'edit-client'=>false,
//                'delete-client'=>false,
//
//                'view-task'=>false,
//                'create-task'=>false,
//                'edit-task'=>false,
//                'delete-task'=>false,
