<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\patient;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(patient::class, function (Faker $faker) {
    return [
        //
        'fname' => $faker->name,
        'lname' => $faker->name,
        'personal_id' => Str::random(10),
        'email' => $faker->unique()->safeEmail,
        'contact' => Str::random(10),
        'address' => "Nairobi",
        'gender' => "Male",
        'dob' => now(),
    ];
});
