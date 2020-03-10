<?php

use Illuminate\Database\Seeder;
use App\Ability;
use App\Role;

class AbilityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create Abilities here
        $ac1 = Ability::create(['name'=>'view-client']);
        $ac2 = Ability::create(['name'=>'create-client']);
        $ac3 = Ability::create(['name'=>'update-client']);
        $ac4 = Ability::create(['name'=>'delete-client']);

        $at1 = Ability::create(['name'=>'view-task']);
        $at2 = Ability::create(['name'=>'create-task']);
        $at3 = Ability::create(['name'=>'update-task']);
        $at4 = Ability::create(['name'=>'delete-task']);


        //fetch roles
        $adminRole = Role::where('name','admin')->first();
      //  $pmRole = Role::where('name','pm')->first();
        $userRole = Role::where('name','user')->first();


        //attach abilities for admin role.
        $ac1->roles()->attach($adminRole->id);
        $ac2->roles()->attach($adminRole);
        $ac3->roles()->attach($adminRole);
        $ac4->roles()->attach($adminRole);

        $at1->roles()->attach($adminRole->id);
        $at2->roles()->attach($adminRole);
        $at3->roles()->attach($adminRole);
        $at4->roles()->attach($adminRole);




        //attach abilities for user role.








    }
}
