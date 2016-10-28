<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'nickname' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'login_times' => 0,
        'status' => 1,
    ];
});

$factory->define(\App\Models\Admin::class, function(Faker\Generator $faker) {
    return [
        'username' => $faker->userName,
        'password' => bcrypt(base64_encode(mt_rand(100000, 999999))),
    ];
});

$factory->define(\App\Models\Category::class, function (\Faker\Generator $faker) {
    return [
        'parent_id' => 0,
        'name' => $faker->name,
    ];
});

$factory->define(\App\Models\Article::class, function(Faker\Generator $faker) {
    $adminIdCollection = \App\Models\Admin::all(['id'])->pluck('id');
    $categoryIdCollection = \App\Models\Category::all(['id'])->pluck('id');
    $start = \Carbon\Carbon::now()->addDays(mt_rand(-20, 0));
    return [
        'category_id' =>$categoryIdCollection->random(),
        'admin_id' => $adminIdCollection->random(),
        'title' => $faker->title,
        'summary' => $faker->sentence,
        'gallery' => $faker->imageUrl(),
        'content' => $faker->paragraph(10),
        'last_user_id' => 0,
        'views' => 0,
        'status' => 1,
        'start_time' => $start->toDateTimeString(),
        'end_time' => $start->addDays(mt_rand(5, 20))->toDateString(),
    ];
});
