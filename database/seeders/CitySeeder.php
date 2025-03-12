<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $citiesRecords = [
            // ['id'=>1,'state_id'=>1,'name'=>'وسط القاهرة'],
            // ['id'=>2,'state_id'=>1,'name'=>'هليوبوليس الجديدة'],
            // ['id'=>3,'state_id'=>1,'name'=>'مصر القديمة'],
            // ['id'=>4,'state_id'=>1,'name'=>'مصر الجديدة'],
            // ['id'=>5,'state_id'=>1,'name'=>'مدينتى'],
            // ['id'=>6,'state_id'=>1,'name'=>'مدينة نصر'],
            // ['id'=>7,'state_id'=>1,'name'=>'مدينة بدر'],
            // ['id'=>8,'state_id'=>1,'name'=>'مدينة المستقبل'],
            // ['id'=>9,'state_id'=>1,'name'=>'مدينةالشروق'],
            // ['id'=>10,'state_id'=>1,'name'=>'مدينة السلام'],
        ];
        City::insert($citiesRecords);
    }
}
