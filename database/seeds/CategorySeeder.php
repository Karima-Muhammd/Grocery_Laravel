<?php

use Illuminate\Database\Seeder;
use App\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => "Fruits",
            'img'=>'category-2.jpg'
        ]);
        Category::create([
            'name' => "Vegetables",
            'img'=>'category-1.jpg'

        ]);
        Category::create([
            'name' => "Dried",
            'img'=>'category-4.jpg'

        ]);
        Category::create([
            'name' => "Juices",
            'img'=>'category-3.jpg'

        ]);
    }
}
