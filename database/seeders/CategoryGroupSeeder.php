<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryGroupSeeder extends Seeder
{
    /**
     * Загрузка начальных данных.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_groups')->insert([
            ['name' => 'Одежда', 'code' => 'clothing', 'active' => true, 'sort' => 10],
            ['name' => 'Обувь', 'code' => 'shoes', 'active' => true, 'sort' => 20],
            ['name' => 'Электроника', 'code' => 'electronics', 'active' => true, 'sort' => 30],
            ['name' => 'Для дома', 'code' => 'house', 'active' => true, 'sort' => 40],
            ['name' => 'Для огорода', 'code' => 'garden', 'active' => true, 'sort' => 50],
            ['name' => 'Детские товары', 'code' => 'children', 'active' => true, 'sort' => 60],
            ['name' => 'Продукты питания', 'code' => 'products', 'active' => true, 'sort' => 70],
            ['name' => 'Мебель', 'code' => 'furniture', 'active' => true, 'sort' => 80],
        ]);
    }
}
