<?php

namespace Database\Seeders;

use App\Models\Nationality;
use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $records = [
            ['id'=>1,'name'=>'مصري/ة','status'=>'1'],
            ['id'=>2,'name'=>'فلسطيني/ة','status'=>'1'],
            ['id'=>3,'name'=>'ليبي/ة','status'=>'1'],
            ['id'=>4,'name'=>'سوري/ة','status'=>'1'],
            ['id'=>5,'name'=>'لبناني/ة','status'=>'1'],
            ['id'=>6,'name'=>'تونسي/ة','status'=>'1'],
            ['id'=>7,'name'=>'جزائري/ة','status'=>'1'],
            ['id'=>8,'name'=>'مغربي/ة','status'=>'1'],
            ['id'=>9,'name'=>'اردني/ة','status'=>'1'],
            ['id'=>10,'name'=>'عراقي/ة','status'=>'1'],
            ['id'=>11,'name'=>'يمني/ة','status'=>'1'],
            ['id'=>12,'name'=>'عماني/ة','status'=>'1'],
        ];
        Nationality::insert($records);
    }
}
