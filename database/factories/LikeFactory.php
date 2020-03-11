<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Models\Post;
use App\Models\User;
use App\Models\Like;
$factory->define(Like::class, function (Faker $faker) {
    return [
        "post_id" => Post::all()->random(1)->first()->id,
        "user_id" => User::all()->random(1)->first()->id
    ];
});
