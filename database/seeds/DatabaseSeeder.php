<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // $this->call(CompaniesTableSeeder::class);
        // $this->call(TownsTableSeeder::class);
        // $this->call(PaymentMethodsTableSeeder::class);
        // $this->call(EventTypesTableSeeder::class);
        // $this->call(ProductTypesTableSeeder::class);
        // $this->call(AnswerSeeder::class);
        // $this->call(NeighborhoodsTableSeeder::class);
        $this->call(UserSeeder::class);
    }
}
