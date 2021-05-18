<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => '1', 'title' => 'Хлебобулочные изделия','alias' => 'bread', 'parent_id' => '0', 'keywords' => 'bread food', 'description' => 'Хлебобулочные изделия', 'img'=>'bread.png'],
            ['id' => '2', 'title' => 'Крупы','alias' => 'cereals', 'parent_id' => '0', 'keywords' => 'cereals гречкаб мука  сахар чечевица', 'description' => 'Крупы', 'img'=>'Cereals.png'],
            ['id' => '3', 'title' => 'Пивные напитки','alias' => 'beer', 'parent_id' => '0', 'keywords' => 'beer alkohol', 'description' => 'Пиво','img'=>'Beer.png'],
            ['id' => '16', 'title' => 'Заморозка','alias' => 'frozen_food', 'parent_id' => '0', 'keywords' => 'Замороженная еда', 'description' => 'Замороженная еда','img'=>'snow.png'],
            ['id' => '5', 'title' => 'Колбасные изделия','alias' => 'sousage', 'parent_id' => '0', 'keywords' => 'колбаса сосиск', 'description' => 'Колбасные изделия','img'=>'sousage.png'],
            ['id' => '6', 'title' => 'Молочная продукция','alias' => 'milk', 'parent_id' => '0', 'keywords' => 'Молоко сыры йогурты кефиры', 'description' => 'Молочная продукция','img'=>'milk.png'],
            ['id' => '7', 'title' => 'Корма для домашних питомцев','alias' => 'pet_food', 'parent_id' => '0', 'keywords' => 'Педигри Чаппи', 'description' => 'Корма для собак и кошек','img'=>'dog.png'],
            ['id' => '8', 'title' => 'Корма для кошек','alias' => 'cat', 'parent_id' => '7', 'keywords' => 'Кошек кошка корм', 'description' => 'Корма для кошек','img'=>'cat.png'],
            ['id' => '9', 'title' => 'Корма для собак','alias' => 'dog', 'parent_id' => '7', 'keywords' => 'Собака собаки корм chappi pedigri', 'description' => 'Корма для собак','img'=>'dog.png'],
            ['id' => '10', 'title' => 'Фрукты','alias' => 'fruits', 'parent_id' => '0', 'keywords' => 'Яблоко бананы клубника апельсин', 'description' => 'Фрукты','img'=>'pineapple.png'],
            ['id' => '11', 'title' => 'Сладости','alias' => 'sweet', 'parent_id' => '0', 'keywords' => 'Пахлава тотр кекс', 'description' => 'Сладости','img'=>'sweet.png'],
            ['id' => '12', 'title' => 'Детское питание','alias' => 'child_food', 'parent_id' => '0', 'keywords' => 'Детское питание', 'description' => 'Детское питание','img'=>'child.png'],
            ['id' => '13', 'title' => 'Бытовая химия','alias' => 'clear', 'parent_id' => '0', 'keywords' => 'бытовая химия', 'description' => 'Бытовая химия','img'=>'clear.png'],
            ['id' => '14', 'title' => 'Стиральные порошки','alias' => 'washing_powder', 'parent_id' => '13', 'keywords' => 'washing powder ariel ', 'description' => 'Стиральные порошки','img'=>'washing_powder.png'],
            ['id' => '15', 'title' => 'Средства для мытия посуды','alias' => 'washing_dishes', 'parent_id' => '13', 'keywords' => 'girls', 'description' => 'Средства для мытия посуды','img'=>'washing_dishes.png'],
            ['id' => '4', 'title' => 'Соки и вода','alias' => 'water', 'parent_id' => '0', 'keywords' => 'water вода соки питеавя', 'description' => 'Питевая вода','img'=>'washing_dishes.png'],

        ];

        DB::table('categories')->insert($data);
    }
}
