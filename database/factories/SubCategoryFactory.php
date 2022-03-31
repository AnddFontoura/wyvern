<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Model;
use App\SubCategory;
use Faker\Generator as Faker;

$factory->define(SubCategory::class, function (Faker $faker) {
    return [
        'category_id' => Factory(Category::class)->create()->id,
        'name' => $faker->name,
        'description' => $faker->text(500),
    ];
});
