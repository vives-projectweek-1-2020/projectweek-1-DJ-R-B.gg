<?php

use App\Issue;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Issue::class, function(Faker $faker){
    return[
        'name' => $faker->name,
        'category' =>$faker->name,
    ];
});