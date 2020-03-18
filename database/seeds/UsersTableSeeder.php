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


        $user1 = User::create(['name'=>'dfgdfg',
                              'email'=>'useerfrefr@user.com',
                              'organisation_id'=>1,
                              'password'=>Hash::make('password')]);

        $user2 = User::create(['name'=>'dfgdhd',
                              'email'=>'usfger@user.com',
                              'organisation_id'=>1,
                              'password'=>Hash::make('password')]);

        $user3 = User::create(['name'=>'wrfgfdg',
                              'email'=>'usedfgr@user.com',
                              'organisation_id'=>1,
                              'password'=>Hash::make('password')]);

        $user4 = User::create(['name'=>'erge rg reg rge',
                              'email'=>'usefdgdfgr@user.com',
                              'organisation_id'=>1,
                              'password'=>Hash::make('password')]);

        $user5 = User::create(['name'=>'e rf refr',
                              'email'=>'uertrgbser@user.com',
                              'organisation_id'=>1,
                              'password'=>Hash::make('password')]);

        $user6 = User::create(['name'=>'Genericdv df dfd user',
                              'email'=>'usesefsqr@user.com',
                              'organisation_id'=>1,
                              'password'=>Hash::make('password')]);

        $user7 = User::create(['name'=>'Generic d user',
                              'email'=>'ushmjgfgber@user.com',
                              'organisation_id'=>1,
                              'password'=>Hash::make('password')]);



$user1->roles()->attach($userRole);
$user2->roles()->attach($userRole);
$user3->roles()->attach($userRole);
$user4->roles()->attach($userRole);
$user5->roles()->attach($userRole);
$user6->roles()->attach($userRole);
$user7->roles()->attach($userRole);





        $admin->roles()->attach($adminRole->id);
        $user->roles()->attach($userRole);
       // $pmRole->users()->attach($pm);

    }
}
