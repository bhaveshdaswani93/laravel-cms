<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        // 'name' => $faker->randomElement(['Javascript','Css','Laravel','Php'])
        'name' => $faker->word
    ];
});
