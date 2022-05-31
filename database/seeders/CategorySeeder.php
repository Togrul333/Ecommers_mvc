<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Мобильные_телефоны','Портативная_техника','Бытовая_техника'];
        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'code' =>$category,
                'name' => $category,
                'description'=>'В этом разделе вы найдёте самые популярные .....!',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
