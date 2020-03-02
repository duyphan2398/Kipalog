<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;
use App\Models\User;
$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(rand(5,20)),
        'content' => $faker->paragraph(rand(30,100)),
        'user_id' => User::all()->random(1)->first()->id,
    ];
});
