<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['content' => '商品のお届けについて'],
            ['content' => '商品交換について'],
            ['content' => '商品トラブル'],
            ['content' => 'ショップへのお問い合わせ'],
            ['content' => 'その他'],
        ];

        // 既存のデータを削除
        DB::table('categories')->delete();

        // AUTO_INCREMENT をリセット（MySQL専用）
        DB::statement('ALTER TABLE categories AUTO_INCREMENT = 1;');

        // データを挿入
        foreach ($categories as $index => $category) {
            DB::table('categories')->insert([
                'id' => $index + 1,
                'content' => $category['content'],
            ]);
        }
    }
}
