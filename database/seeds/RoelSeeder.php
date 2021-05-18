<?php

use Illuminate\Database\Seeder;

class RoelSeeder extends Seeder
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
                'id' =>1,
                'name' => 'disabled',
            ],
            [
                'id' =>2,
                'name' => 'user',
            ],
            [
                'id' =>3,
                'name' => 'admin',
            ],
        ];
        DB::table('roles')->insert($data);
    }
}
