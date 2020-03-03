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
        Role::create([
            'name'=>'admin',
            'permissions'=>json_encode([
                'view-client'=>true,
                'create-client'=>true,
                'edit-client'=>true,
                'delete-client'=>true,

                'view-task'=>true,
                'create-task'=>true,
                'edit-task'=>true,
                'delete-task'=>true,
                ]),
        ]);

        Role::create([
            'name'=>'pm',
            'permissions'=>json_encode([
                'view-client'=>true,
                'create-client'=>false,
                'edit-client'=>false,
                'delete-client'=>false,

                'view-task'=>true,
                'create-task'=>false,
                'edit-task'=>false,
                'delete-task'=>false,
                ])
        ]);

        Role::create([
            'name'=>'user',
            'permissions'=>json_encode([
                'view-client'=>false,
                'create-client'=>false,
                'edit-client'=>false,
                'delete-client'=>false,

                'view-task'=>false,
                'create-task'=>false,
                'edit-task'=>false,
                'delete-task'=>false,
            ])
        ]);

    }
}
