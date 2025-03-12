<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $records = [
            ['id'=>1,'section_id'=>1,'name'=>'المشويات','slug'=>'المشويات','status'=>'1'],
            ['id'=>2,'section_id'=>1,'name'=>'المحاشى','slug'=>'المحاشى','status'=>'1'],
            ['id'=>3,'section_id'=>1,'name'=>'الخضروات','slug'=>'الخضروات','status'=>'1'],
            ['id'=>4,'section_id'=>1,'name'=>'الطواجن','slug'=>'الطواجن','status'=>'1'],
        ];
        Category::insert($records);
    }
}
