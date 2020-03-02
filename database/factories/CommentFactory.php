<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use Faker\Generator as Faker;
use  App\Models\User;
use App\Models\Post;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->sentence(rand(10,30)),
        'user_id' => User::all()->random(1)->first()->id,
        'post_id' => Post::all()->random(1)->first()->id
    ];
});
