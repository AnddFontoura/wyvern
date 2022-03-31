<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Product;
use App\SubCategory;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'sub_category_id' => Factory(SubCategory::class)->create()->id,
        'name' => $faker->name,
        'description' => $faker->text(500),
        'isbn' => $faker->randomAscii(),
        'codebar' => $faker->randomAscii(),
        'weight' => $faker->randomFloat(2,0),
        'width' => $faker->randomFloat(2,0),
        'height' => $faker->randomFloat(2,0),
        'depth' => $faker->randomFloat(2,0),
        'price' => $faker->randomFloat(2,0),
    ];
});
