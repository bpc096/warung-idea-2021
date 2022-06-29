<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = ['Bill Petrus', 'Jeffrey Marcellino', 'Faisal Ghozi', 'Andi Hehe', 'Budi Hoho','Indira Flewx'];
      for($c=1;$c<=6;$c++){
        DB::table('users')->insert([
          'name' => $user[$c-1],
          'email' => Str::random(10).'@gmail.com',
          'password' => Hash::make('password'),
          'role' => 3,
        ]);
      }
    }
}
