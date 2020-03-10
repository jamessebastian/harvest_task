<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //User::truncate();
        DB::table('role_user')->truncate();

        $adminRole = Role::where('name','admin')->first();
       // $pmRole = Role::where('name','pm')->first();
        $userRole = Role::where('name','user')->first();

        $admin= User::create(['name'=>'Admin user',
                              'email'=>'admin@admin.com',
                              'organisation_id'=>1,
                              'password'=>Hash::make('password')]);

//        $pm = User::create(['name'=>'proj manager',
//                                'email'=>'pm@pm.com',
//                                'organisation_id'=>1,
//                                'password'=>Hash::make('password')]);

        $user = User::create(['name'=>'Generic user',
                              'email'=>'user@user.com',
                              'organisation_id'=>1,
                              'password'=>Hash::make('password')]);

        $admin->roles()->attach($adminRole->id);
        $user->roles()->attach($userRole);
       // $pmRole->users()->attach($pm);

    }
}
