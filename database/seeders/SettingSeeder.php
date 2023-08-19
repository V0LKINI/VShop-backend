<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class SettingSeeder extends Seeder
{
    /**
     * Загрузка начальных данных.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'key' => 'main_banner',
                'name' => 'Баннер на главной',
                'description' => 'Баннер на главной странице, под категориями',
                'value' => 'http://localhost:8080/banner.webp',
                'type' => 'S',
                'sort' => 100,
                'active' => true
            ],
        ]);
    }
}
