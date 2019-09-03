<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(5),
        'isbn' => $faker->isbn13,
        'description' => $faker->text(),
        'user_id' => function () {
            return factory(\App\Models\User::class)->create()->id;
        }
    ];
});
