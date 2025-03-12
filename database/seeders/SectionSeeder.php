<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $records = [
            ['id'=>1,'name'=>'الطبخ','slug'=>'الطبخ','status'=>'1'],
            ['id'=>2,'name'=>'المعجنات','slug'=>'المعجنات','status'=>'1'],
            ['id'=>3,'name'=>'الحلويات','slug'=>'الحلويات','status'=>'1'],
            ['id'=>4,'name'=>'المشروبات','slug'=>'المشروبات','status'=>'1'],
        ];
        Section::insert($records);
    }
}
