<?php

/** @var Factory $factory */

use App\Category;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'description' => $faker->text(1000),
        'icon' => 'fas fa-edit',
    ];
});
