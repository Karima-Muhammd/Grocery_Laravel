<?php

use Illuminate\Database\Seeder;
use App\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       ;
        Product::create([
            'name' => "BELL PEPPER", 'quantity' =>50, 'price' => 80,
            'img'=>'product-1.jpg','category_id'=>2,'status'=>1,'offer'=>30
        ]);
        Product::create([
            'name' => "STRAWBERRY", 'quantity' =>30, 'price' => 100,
            'img'=>'product-2.jpg','category_id'=>1,'status'=>1
        ]);
        Product::create([
            'name' => "GREEN BEANS", 'quantity' =>70, 'price' => 30,
            'img'=>'product-3.jpg','category_id'=>2,'status'=>1
        ]);
        Product::create([
            'name' => "PURPLE CABBAGE", 'quantity' =>40, 'price' => 10,
            'img'=>'product-4.jpg','category_id'=>2,'status'=>1
        ]);
        Product::create([
            'name' => "MANGO", 'quantity' =>40, 'price' => 40,
            'img'=>'product5fcaabf5b87d7.jpg','category_id'=>3,'status'=>1
        ]);
        Product::create([
            'name' => "TOMATOE", 'quantity' =>40, 'price' => 70,
            'img'=>'product-5.jpg','category_id'=>2,'status'=>1,'offer'=>30
        ]);
        Product::create([
            'name' => "BROCOLLI", 'quantity' =>40, 'price' => 32,
            'img'=>'product-6.jpg','category_id'=>2,'status'=>1
        ]);
        Product::create([
            'name' => "CARROTS", 'quantity' =>40, 'price' => 15,
            'img'=>'product-7.jpg','category_id'=>2,'status'=>1
        ]);
        Product::create([
            'name' => "FRUIT JUICE", 'quantity' =>50, 'price' => 120,
            'img'=>'product-8.jpg','category_id'=>4,'status'=>1
        ]);
        Product::create([
            'name' => "ONION", 'quantity' =>140, 'price' => 45,
            'img'=>'product-9.jpg','category_id'=>2,'status'=>1
        ]);
          Product::create([
            'name' => "APPLE", 'quantity' =>90, 'price' => 145,
            'img'=>'product-10.jpg','category_id'=>1,'status'=>1
        ]);
          Product::create([
            'name' => "GARLIC", 'quantity' =>20, 'price' => 25,
            'img'=>'product-11.jpg','category_id'=>2,'status'=>1
        ]);
          Product::create([
            'name' => "CHILLI", 'quantity' =>140, 'price' => 65,
            'img'=>'product-12.jpg','category_id'=>2,'status'=>1
        ]);

    }
}
