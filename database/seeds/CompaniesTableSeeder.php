<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([

                [
                    'name' => 'Empresa 1',
                    'cbu' => '55555566666667777777',
                    'cuit' => '22-99887776-3',
                    'cbu_alias' => 'ALIAS DE CBU',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            ]);
    }
}




/*
INSERT INTO `empresas` (`id`, `nombre`, `cbu`, `cuit`, `cbu_aliasl`) VALUES
(1, 'Empresa 1', '2222222222222222222222', '33333333333', 'empresa1');


*/