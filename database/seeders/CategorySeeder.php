<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            'name'=> 'Meats',
            'description'=>'all types of meat ( chicken , fish , beef , burger , ..)',
            'image'=>'categories/meats.jpg',
        ]);
        Category::create([
            'name'=> 'Fruits',
            'description'=>'all types of fruits ( banana , apple , mango , ..)',
            'image'=>'categories/fruits.jpg',
        ]);
        Category::create([
            'name'=> 'Vegetables',
            'description'=>'all types of vegetables ( tomato , potato , cucumber , ..)',
            'image'=>'categories/vegetables.jpg',
        ]);
        Category::create([
            'name'=> 'Bakery',
            'description'=>'all types of baked foods ( bread , cookies , deserts , ..)',
            'image'=>'categories/bakery.jpg',
        ]);
    }
}
