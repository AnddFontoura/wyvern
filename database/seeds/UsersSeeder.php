<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->delete();

      DB::table('users')->insert([
        [
          'name' => 'Andre Fontoura',
          'email' => 'andd.fontoura@hotmail.com',
          'password' => Hash::make('drake210591'),
          'created_at' => Carbon::now()->format('Y-m-d h:i:s'),
        ],

      ]);
    }
}
