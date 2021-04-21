<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
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
                'id' => 1,
                'name' => 'Levon',
                'email' => 'levon@admin.ru',
                'password' => bcrypt(12345678),
            ],
            [
                'id' => 2,
                'name' => 'Karan Yeaton',
                'email' => 'Karan@u.ru',
                'password' => bcrypt(12345678),
            ],
            [
                'id' => 3,
                'name' => 'Ashton Merkel',
                'email' => 'Ashton@admin.ru8',
                'password' => bcrypt(12345678),
            ],
            [
                'id' => 4,
                'name' => 'Sandi Newhard',
                'email' => 'Sandi@admin.ru9',
                'password' => bcrypt(12345678),
            ],
            [
                'id' => 5,
                'name' => 'Analisa Revell',
                'email' => 'Analisa@admin.ru10',
                'password' => bcrypt(12345678),
            ],
            [
                'id' => 6,
                'name' => 'Tim Strand',
                'email' => 'Tim@admin.ru11',
                'password' => bcrypt(12345678),
            ],
            [
                'id' => 7,
                'name' => 'Jayme Woodworth',
                'email' => 'Jayme@admin.ru12',
                'password' => bcrypt(12345678),
            ],
            [
                'id' => 8,
                'name' => 'Will Vanderpool',
                'email' => 'Will@admin.ru13',
                'password' => bcrypt(12345678),
            ],
            [
                'id' => 9,
                'name' => 'Mila Bergen',
                'email' => 'Mila@admin.ru14',
                'password' => bcrypt(12345678),
            ],
            [
                'id' => 10,
                'name' => 'Aliza Havis',
                'email' => 'Aliza@admin.ru15',
                'password' => bcrypt(12345678),
            ],
            [
                'id' => 11,
                'name' => 'Antonina Mcevoy',
                'email' => 'Antonina@admin.ru16',
                'password' => bcrypt(12345678),
            ],
            [
                'id' => 12,
                'name' => 'Elenor Cawley',
                'email' => 'Elenor@admin.ru17',
                'password' => bcrypt(12345678),
            ],
        ];
        DB::table('users')->insert($data);
    }
}
