<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'password' => $password ?: $password = 'secret',
        'remember_token' => str_random(10),
        'description' => $faker->paragraph(1),
        'email' => $faker->unique()->safeEmail,
        'facebook' => implode(' ', $faker->words(2)),
        'twitter' => implode(' ', $faker->words(2)),
        'avatar' => $faker->image($dir = '/tmp', $width = 320, $height = 240),
        'background' => $faker->image($dir = '/tmp', $width = 640, $height = 480),
        'is_admin' => false,
    ];
});

$factory->define(App\Models\Follow::class, function (Faker $faker) {
    return [
        'status' => (bool)rand(0, 1),
    ];
});

$factory->define(App\Models\Category::class, function (Faker $faker) {
    return [
        'name' => implode(' ', $faker->words(2)),
        'parent_id' => 0,
    ];
});

$factory->define(App\Models\Course::class, function (Faker $faker) {
    return [
        'category_id' => App\Models\Category::where('parent_id', '<>', 0)->get()->random()->id,
        'name' => implode(' ', $faker->words(3)),
        'information' => $faker->paragraph(1),
        'rank' => $faker->unique()->numberBetween(1, 15),
        'picture' => $faker->unique()->image($dir = '/tmp', $width = 640, $height = 480),
        'number_of_lesson' => $faker->numberBetween(4, 6),
    ];
});

$factory->define(App\Models\Lesson::class, function (Faker $faker) {
    return [
        'course_id' => App\Models\Course::all()->random()->id,
        'name' => implode(' ', $faker->words(3)),
        'content' => $faker->paragraph(1),
        'point' => $faker->numberBetween(3, 5) * 10,
        'number_of_word' => $faker->numberBetween(5, 10),
    ];
});

$factory->define(App\Models\WordList::class, function (Faker $faker) {
    return [
        'lesson_id' => App\Models\Lesson::all()->random()->id,
        'name' => implode(' ', $faker->words(1)),
        'pronunciation' => implode(' ', $faker->words(1)),
        'explain' => $faker->paragraph(1),
        'file_listen' => implode(' ', $faker->words(3)) . '.mp3',
    ];
});

$factory->define(App\Models\Test::class, function (Faker $faker) {
    $time = $faker->numberBetween(8, 15);

    return [
        'lesson_id' => App\Models\Lesson::all()->random()->id,
        'time' => $time,
        'point_need_pass' => ($time - 3) * 10,
    ];
});

$factory->define(App\Models\Question::class, function (Faker $faker) {
    return [
        'content' => $faker->sentence,
        'number_of_answer' => $faker->numberBetween(3, 5),
    ];
});

$factory->define(App\Models\Answer::class, function (Faker $faker) {
    return [
        'content' => $faker->sentence,
        'is_correct' => false,
    ];
});

$factory->define(App\Models\Study::class, function (Faker $faker) {
    $courseId = App\Models\Course::all()->random()->id;
    $score = App\Models\Course::find($courseId)->number_of_lesson * 10;

    return [
        'user_id' => App\Models\User::all()->random()->id,
        'course_id' => $courseId,
        'score' => $score,
    ];
});
