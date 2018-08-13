<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           DB::table('users')->insert([

                  [
                      'first_name' => 'admin',
                      'last_name' => 'admin',
                      'email' => 'admin@admin.com',
                      'password' => password_hash('123456', PASSWORD_DEFAULT),
                      'active' => 1,
                      'admin' => 1,
                      'created_at' => date('Y-m-d H:i:s'),
                      'updated_at' => date('Y-m-d H:i:s'),
                  ]
              ]);
    }
}
