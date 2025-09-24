<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item = Item::create([
            'user_id' => 1,
            'item_name' => '腕時計',
            'item_img_file' =>'Armani_Mens_Clock.jpg',
            'price' => 15000,
            'condition' => '良好',
            'brand_name' => 'Rolax',
            'detail' => 'スタイリッシュなデザインのメンズ腕時計',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $item->categories()->attach([1, 5, 12]);

        $item = Item::create([
            'user_id' => 1,
            'item_name' => 'HDD',
            'item_img_file' =>'HDD_Hard_Disk.jpg',
            'price' => 5000,
            'condition' => '目立った傷や汚れ無し',
            'brand_name' => '西芝',
            'detail' => '高速で信頼性の高いハードディスク',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $item->categories()->attach([2]);

        $item = Item::create([
            'user_id' => 2,
            'item_name' => '玉ねぎ3束',
            'item_img_file' =>'iLoveIMG_d.jpg',
            'price' => 3000,
            'condition' => 'やや傷や汚れあり',
            'brand_name' => 'なし',
            'detail' => '新鮮な玉ねぎ3束のセット',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $item->categories()->attach([10]);

        $item = Item::create([
            'user_id' => 2,
            'item_name' => '革靴',
            'item_img_file' =>'Leather_Shoes+Product_Photo.jpg',
            'price' => 4000,
            'condition' => '状態が悪い',
            'brand_name' => '',
            'detail' => 'クラシックなデザインの革靴',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $item->categories()->attach([1, 5]);

        $item = Item::create([
            'user_id' => 1,
            'item_name' => 'ノートPC',
            'item_img_file' =>'Living_Room_Laptop.jpg',
            'price' => 45000,
            'condition' => '良好',
            'brand_name' => '',
            'detail' => '高性能なノートパソコン',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $item->categories()->attach([2]);

        $item = Item::create([
            'user_id' => 1,
            'item_name' => 'マイク',
            'item_img_file' =>'Music_Mic_4632231.jpg',
            'price' => 8000,
            'condition' => '目立った傷や汚れ無し',
            'brand_name' => 'なし',
            'detail' => '高音質のレコーディング用マイク',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $item->categories()->attach([2]);

        $item = Item::create([
            'user_id' => 2,
            'item_name' => 'ショルダーバック',
            'item_img_file' =>'Purse_fashion_pocket.jpg',
            'price' => 3500,
            'condition' => 'やや傷や汚れあり',
            'brand_name' => '',
            'detail' => 'おしゃれなショルダーバック',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $item->categories()->attach([1, 4]);

        $item = Item::create([
            'user_id' => 2,
            'item_name' => 'タンブラー',
            'item_img_file' =>'Tumbler_souvenir.jpg',
            'price' => 500,
            'condition' => '状態が悪い',
            'brand_name' => 'なし',
            'detail' => '使いやすいタンブラー',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $item->categories()->attach([10]);

        $item = Item::create([
            'user_id' => 1,
            'item_name' => 'コーヒーミル',
            'item_img_file' =>'Waitress_with+Coffee_Grinder.jpg',
            'price' => 4000,
            'condition' => '良好',
            'brand_name' => 'Starbacks',
            'detail' => '手動のコーヒーミル',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $item->categories()->attach([10]);

        $item = Item::create([
            'user_id' => 1,
            'item_name' => 'メイクセット',
            'item_img_file' =>'外出メイクアップセット.jpg',
            'price' => 2500,
            'condition' => '目立った傷や汚れ無し',
            'brand_name' => '',
            'detail' => '便利なメイクアップセット',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $item->categories()->attach([6]);
    }
}