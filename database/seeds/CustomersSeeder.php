<?php

use Illuminate\Database\Seeder;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('customers')->delete();

      DB::table('customers')->insert([
        [
          'name' => 'Cliente teste',
          'nick_name' =>'Cliente Teste',
          'is_suplier' => 0,
          'created_at' => Carbon::now()->format('Y-m-d h:i:s'),
        ],
        [
          'name' => 'Fornecedor teste',
          'nick_name' =>'Fornecedor Teste',
          'is_suplier' => 0,
          'created_at' => Carbon::now()->format('Y-m-d h:i:s'),
        ],
      ]);
    }
}
