<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DiscountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('discounts')->insert([
            'good_id'=>1,
            'price'=> 8000,
            'start'=> Carbon::parse('2016-01-01'),
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('discounts')->insert([
            'good_id'=>1,
            'price'=> 12000,
            'start'=> Carbon::parse('2016-05-01'),
            'end'=> Carbon::parse('2017-01-01'),
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('discounts')->insert([
            'good_id'=>1,
            'price'=> 15000,
            'start'=> Carbon::parse('2016-07-01'),
            'end'=> Carbon::parse('2016-09-10'),
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('discounts')->insert([
            'good_id'=>1,
            'price'=> 20000,
            'start'=> Carbon::parse('2017-06-01'),
            'end'=> Carbon::parse('2017-10-20'),
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('discounts')->insert([
            'good_id'=>1,
            'price'=> 5000,
            'start'=> Carbon::parse('2017-12-15'),
            'end'=> Carbon::parse('2017-12-31'),
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
