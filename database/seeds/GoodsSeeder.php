<?php

use Illuminate\Database\Seeder;

class GoodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('goods')->insert([
            'id'=>1,
            'name'=>'Школьная форма',
            'default_price'=>10000
        ]);
        DB::table('goods')->insert([
            'id'=>2,
            'name'=>'Учебники',
            'default_price'=>500
        ]);
    }
}
