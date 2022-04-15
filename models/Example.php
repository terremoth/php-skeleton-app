<?php

namespace Models;
use Faker\Factory as Faker;

class Example
{
    public function show()
    {
        $faker = Faker::create();
        echoln("Showing random paragraphs:");
        echo $faker->paragraph(mt_rand(5,10));
    }
}