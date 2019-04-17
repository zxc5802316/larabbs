<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Tag::class, function (Faker $faker) {
    $arr  =  [10,20,12,34,45,64,66];
    return [
        'name' => $faker->name,
        'topic_count' => $faker->randomElement($arr),
    ];
});