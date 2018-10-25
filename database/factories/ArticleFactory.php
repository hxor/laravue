<?php

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(10),
        'body' => $faker->sentence(200)
    ];
});
