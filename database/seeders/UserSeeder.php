<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('pt_BR');
        $total_records = 20;

        for ($i=0; $i < $total_records; $i++) { 

            $firstName = $faker->firstName();
            $lastName = $faker->lastName();

            $email = strtolower($firstName) . strtolower($lastName) . '@gmail.com';
            $email = preg_replace('/[^a-z0-9.@]/', '', $email);
            
            DB::table('users')->insert([
                'name' => $firstName . " " .  $lastName,
                'email' => $email,
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
    
            ]);

        }
    }
}
