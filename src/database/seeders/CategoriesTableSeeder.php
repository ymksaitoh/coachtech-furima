<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('categories')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $contents = [
            "ファッション",
            "家電",
            "インテリア",
            "レディース",
            "メンズ",
            "コスメ",
            "本",
            "ゲーム",
            "スポーツ",
            "キッチン",
            "ハンドメイド",
            "アクセサリー",
            "おもちゃ",
            "ベビー・キッズ",
        ];

        foreach ($contents as $content)
            DB::table('categories')->insert([
                'content' => $content,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }
}
