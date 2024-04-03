<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Car::truncate();
        $data = [
            ["color" => "red","category_id" => 1,"model" => "abc", "registration_no"=>"abc","make" => "abc"],
            ["color" => "blue","category_id" => 2,"model" => "abc", "registration_no"=>"abc","make" => "abc"],
            ["color" => "yellow","category_id" => 3,"model" => "abc", "registration_no"=>"abc","make" => "abc"],
            ["color" => "green","category_id" => 2,"model" => "abc", "registration_no"=>"abc","make" => "abc"],
            ["color" => "black","category_id" => 1,"model" => "abc", "registration_no"=>"abc","make" => "abc"],
            ["color" => "red","category_id" => 1,"model" => "abc", "registration_no"=>"abc","make" => "abc"],
            ["color" => "blue","category_id" => 2,"model" => "abc", "registration_no"=>"abc","make" => "abc"],
            ["color" => "yellow","category_id" => 3,"model" => "abc", "registration_no"=>"abc","make" => "abc"],
            ["color" => "green","category_id" => 2,"model" => "abc", "registration_no"=>"abc","make" => "abc"],
        ];
        Car::insert($data);

    }
}
