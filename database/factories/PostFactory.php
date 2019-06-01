<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3),
        'description'=> $faker->sentence(15),
        'content' => $faker->paragraph(8),
        'published_at' => $faker->dateTimeBetween('- 2 years','now'),
        'image' => 'posts/zl8bBtwqgE8sqHy5yz3TdYyBIKPIMgkR7181y9Je.jpeg',
        'category_id' => function() {
            return factory(App\Category::class)->create()->id;
        }
    ];
});
