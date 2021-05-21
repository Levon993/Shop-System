<?php

use Illuminate\Database\Seeder;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'title' => 'Простоквашино',
                'alias' => 'prostokvashion',
                'img' => 'prostokvashino.jpg',
                'description' => 'Молочная продукция'
            ],
            [
                'id' => '2',
                'title' => 'Домик в деревне',
                'alias' => 'citizen',
                'img' => 'Mol_dom.jpg',
                'description' => 'Молочная продукция'
            ],
            [
                'id' => '3',
                'title' => 'ООО Яйца',
                'alias' => 'eggs',
                'img' => 'eggs.jpg',
                'description' => 'Яйца'
            ],
            [
                'id' => '4',
                'title' => 'Coca Cola',
                'alias' => 'Coca_Cola',
                'img' => 'Coca_Cola.jpg',
                'description' => 'Газированные напитки'
            ],
            [
                'id' => '5',
                'title' => 'Мистраль',
                'alias' => 'mistral',
                'img' => 'mistal.jpg',
                'description' => 'Крупы'
            ],
            [
                'id' => '6',
                'title' => 'ООО Вода',
                'alias' => 'water1',
                'img' => 'water.jpg',
                'description' => 'Вода питевая'
            ],
            [
                'id' => '7',
                'title' => 'Вода',
                'alias' => 'water2',
                'img' => 'water.jpg',
                'description' => 'Вода питевая'
            ],
            [
                'id' => '8',
                'title' => 'Пиво',
                'alias' => 'water3',
                'img' => 'water.jpg',
                'description' => 'Вода питевая'
            ],

        ];

        DB::table('brands')->insert($data);
    }
}
