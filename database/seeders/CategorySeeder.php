<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Загрузка начальных данных.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['category_group_id' => 1, 'name' => 'Футболки', 'code' => 't_shirts', 'active' => true, 'sort' => 10],
            ['category_group_id' => 1, 'name' => 'Шорты', 'code' => 'shorts', 'active' => true, 'sort' => 20],
            ['category_group_id' => 1, 'name' => 'Кофты', 'code' => 'sweatshirts', 'active' => true, 'sort' => 30],
            ['category_group_id' => 1, 'name' => 'Штаны', 'code' => 'trousers', 'active' => true, 'sort' => 40],
            ['category_group_id' => 1, 'name' => 'Джинсы', 'code' => 'jeans', 'active' => true, 'sort' => 50],
            ['category_group_id' => 1, 'name' => 'Нижнее бельё', 'code' => 'underwear', 'active' => true, 'sort' => 60],
            ['category_group_id' => 1, 'name' => 'Куртки', 'code' => 'jackets', 'active' => true, 'sort' => 70],

            ['category_group_id' => 2, 'name' => 'Кроссовки', 'code' => 'sneakers', 'active' => true, 'sort' => 10],
            ['category_group_id' => 2, 'name' => 'Ботинки', 'code' => 'boots', 'active' => true, 'sort' => 20],
            ['category_group_id' => 2, 'name' => 'Туфли', 'code' => 'shoes', 'active' => true, 'sort' => 30],

            ['category_group_id' => 3, 'name' => 'Бытовая техника', 'code' => 'appliances', 'active' => true, 'sort' => 10],
            ['category_group_id' => 3, 'name' => 'Компьютерная периферия', 'code' => 'computer_peripherals', 'active' => true, 'sort' => 20],
            ['category_group_id' => 3, 'name' => 'Кухонная техника', 'code' => 'kitchen_appliances', 'active' => true, 'sort' => 30],

            ['category_group_id' => 4, 'name' => 'Шторки', 'code' => 'blinds', 'active' => true, 'sort' => 10],
            ['category_group_id' => 4, 'name' => 'Ковры', 'code' => 'carpets', 'active' => true, 'sort' => 20],
            ['category_group_id' => 4, 'name' => 'Краска', 'code' => 'paint', 'active' => true, 'sort' => 30],

            ['category_group_id' => 5, 'name' => 'Семена', 'code' => 'seeds', 'active' => true, 'sort' => 10],
            ['category_group_id' => 5, 'name' => 'Инструменты', 'code' => 'tools', 'active' => true, 'sort' => 20],
            ['category_group_id' => 5, 'name' => 'Удобрения', 'code' => 'fertilizers', 'active' => true, 'sort' => 30],

            ['category_group_id' => 6, 'name' => 'Питание', 'code' => 'baby_food', 'active' => true, 'sort' => 10],
            ['category_group_id' => 6, 'name' => 'Подгузники', 'code' => 'diapers', 'active' => true, 'sort' => 20],

            ['category_group_id' => 7, 'name' => 'Молочные продукты', 'code' => 'milk_products', 'active' => true, 'sort' => 10],
            ['category_group_id' => 7, 'name' => 'Хлебные изделия', 'code' => 'bread_products', 'active' => true, 'sort' => 20],
            ['category_group_id' => 7, 'name' => 'Рыба', 'code' => 'fish', 'active' => true, 'sort' => 30],
            ['category_group_id' => 7, 'name' => 'Мясо', 'code' => 'meat', 'active' => true, 'sort' => 40],

            ['category_group_id' => 8, 'name' => 'Диваны', 'code' => 'sofas', 'active' => true, 'sort' => 20],
            ['category_group_id' => 8, 'name' => 'Столы', 'code' => 'tables', 'active' => true, 'sort' => 20],
            ['category_group_id' => 8, 'name' => 'Стулья', 'code' => 'chairs', 'active' => true, 'sort' => 30],
            ['category_group_id' => 8, 'name' => 'Кровати', 'code' => 'beds', 'active' => true, 'sort' => 40],
        ]);
    }
}
