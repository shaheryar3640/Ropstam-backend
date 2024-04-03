<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::truncate();
        
        $data = [
            ['name' => 'Bus'],
            ['name' => 'Sedan'],
            ['name' => 'SUV'],
            ['name' => 'Hatchback'],
        ];
        Category::insert($data);
        // $faker = Faker::create();
        // foreach (range(1, 18) as $index) {
        //     DB::table('categories')->insert([
        //         'name' => $faker->text(18)
        //     ]);
        // }
    }
}
