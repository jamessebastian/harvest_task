<?php

use Illuminate\Database\Seeder;
use App\Clients;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clients::create(['name'=>'client1',
            'address'=>'tom house,mavelikara',
            'organisation_id'=>1,
            'currency'=>'USD']);

        Clients::create(['name'=>'client2',
            'address'=>'steve house,budha jn',
            'organisation_id'=>1,
            'currency'=>'INR']);

        Clients::create(['name'=>'client3',
            'address'=>'gerrard house,budha jn',
            'organisation_id'=>1,
            'currency'=>'INR']);

    }
}
