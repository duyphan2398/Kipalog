<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
/*
|--------------------------------------------------------------------------
| ModelS Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $arr = [null, now()];
    return [
        'name' => $faker->name,
        'username' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'avatar' => 'images/default.png',
        'email_verified_at' => now(),
        'deleted_at' => Arr::random($arr),
        'password' => Str::random(8,'alphaNum'),
        'remember_token' => Str::random(10),
    ];
});
