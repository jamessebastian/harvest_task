<?php

use Illuminate\Database\Seeder;
use App\Tasks;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tasks::create(['name'=>'task1',
            'hourly_rate'=>555,
            'organisation_id'=>1]);

        Tasks::create(['name'=>'task2',
            'hourly_rate'=>555,
            'organisation_id'=>1]);

        Tasks::create(['name'=>'task3',
            'hourly_rate'=>555,
            'organisation_id'=>1]);
    }
}
