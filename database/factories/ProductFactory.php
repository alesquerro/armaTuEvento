<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
  //Para crear Salones descomentar esto
  return [
    'name' => $faker->name,
    'mail' => $faker->unique()->safeEmail,
    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ',
    'type' => 'salon',
    'price' => 12000,
    'minimum_reservation' => 3000,
    'capacity' => 120,
    'product_type_id' => 1,
    'company_id' => 1,
    'cover' => 'salonConferencia.jpg',
    'active' =>1,
  ];
  //Para crear Servicio descomentar esto
  // return [
  //   'name' => $faker->name,
  //   'mail' => $faker->unique()->safeEmail,
  //   'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ',
  //   'type' => 'servicio',
  //   'price' => 5000,
  //   'minimum_reservation' => 700,
  //   'product_type_id' => 1,
  //   'company_id' => 1,
  //   'cover' => 'dj1.jpg',
  //   'active' =>1,
  // ];
});
