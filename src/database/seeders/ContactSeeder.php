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

        // categoriesテーブルのIDを取得
        $categoryIds = DB::table('categories')->pluck('id')->toArray();
        if (empty($categoryIds)) {
            throw new \Exception('Categories table is empty. Please run CategoriesSeeder first.');
        }

        // 外部キー制約を無効化
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // テーブルをリセット
        DB::table('contacts')->truncate();

        // 外部キー制約を再有効化
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');



        // ダミーデータを35件挿入
        for ($i = 0; $i < 35; $i++) {
            DB::table('contacts')->insert([
                'category_id' => $faker->randomElement($categoryIds),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'address' => $faker->address,
                'building' => $faker->optional()->streetName,
                'detail' => $faker->paragraph,
                'gender' => $faker->randomElement([1, 2, 3]),
                'tell' => $faker->phoneNumber,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
