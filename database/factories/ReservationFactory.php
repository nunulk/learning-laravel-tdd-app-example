<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Reservation;
use Faker\Generator as Faker;

$factory->define(Reservation::class, function (Faker $faker) {
    return [
        'lesson_id' => null,
        'user_id' => null,
    ];
});
