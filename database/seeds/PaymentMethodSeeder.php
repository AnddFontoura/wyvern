<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->delete();

        DB::table('payment_methods')->insert([
          [
            'name' => 'Cartão de Crédito',
            'created_at' => Carbon::now()->format('Y-m-d h:i:s'),
          ],
          [
            'name' => 'Cartão de Débito',
            'created_at' => Carbon::now()->format('Y-m-d h:i:s'),
          ],
          [
            'name' => 'Dinheiro',
            'created_at' => Carbon::now()->format('Y-m-d h:i:s'),
          ],
          [
            'name' => 'Boleto',
            'created_at' => Carbon::now()->format('Y-m-d h:i:s'),
          ],
          [
            'name' => 'Transferência',
            'created_at' => Carbon::now()->format('Y-m-d h:i:s'),
          ],
        ]);

    }
}
