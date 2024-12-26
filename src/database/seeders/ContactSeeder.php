<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // ダミーデータを35件挿入
        for ($i = 0; $i < 35; $i++) {
            DB::table('contacts')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'address' => $faker->address,
                'building' => $faker->optional()->streetName,
                'inquiry_type' => $faker->randomElement(['service', 'support', 'sales']),
                'content' => $faker->paragraph,
                'gender' => $faker->randomElement(['male', 'female']),
                'tel' => $faker->phoneNumber,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
