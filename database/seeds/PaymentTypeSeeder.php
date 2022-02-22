<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_types')->delete();

        DB::table('payment_types')->insert([
          [
            'name' => 'Entrada',
            'created_at' => Carbon::now()->format('Y-m-d h:i:s'),
          ],
          [
            'name' => 'Saída',
            'created_at' => Carbon::now()->format('Y-m-d h:i:s'),
          ],
        ]);
    }
}
