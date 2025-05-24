<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Modules\Question\Entities\Question;

$factory->define(Question::class, function (Faker $faker) {
    return [
        //
        "is_active" => true,
        "ar"=>[
                "question"=>$faker->sentence(6, true),
                "answer"  => "<p>".$faker->text( 200) ."</p>",
        ],
        "en"=>[
            "question"=>$faker->sentence( 6, true),
            "answer"  => "<p>".$faker->text(200) ."</p>",
        ]
    ];
});
