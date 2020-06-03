<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserProfile;
use Faker\Generator as Faker;

$factory->define(UserProfile::class, function (Faker $faker) {
    return [
        'plan' => $faker->randomElement(['regular', 'gold']),
        'sex' => $faker->randomElement(['female', 'male']),
        'age' => $faker->numberBetween(0, 100),
    ];
});
