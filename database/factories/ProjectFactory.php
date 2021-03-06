<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Projects;
use Faker\Generator as Faker;

$factory->define(Projects::class, function (Faker $faker) {
    return [
        'clients_id'=> factory(\App\Clients::class),
        'name' => $faker->name
    ];
});
