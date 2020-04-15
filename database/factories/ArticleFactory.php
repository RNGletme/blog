<?php

use Faker\Generator as Faker;

$factory->define(\App\Article::class, function (Faker $faker) {
    return [
    	'title' => $faker->title,
	    'content' => $faker->text,
	    'user_id' => $faker->biasedNumberBetween(1, 5),
	    'kind_id' => $faker->biasedNumberBetween(1,3),
	    'created_at' => $faker->dateTime,
	    'updated_at' => $faker->dateTime
    ];
});
