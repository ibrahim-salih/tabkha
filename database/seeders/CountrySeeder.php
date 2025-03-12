<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $countriesRecords = [
            ['id'=>1,'name'=>'القاهرة'],
            ['id'=>2,'name'=>'الجيزة'],
            ['id'=>3,'name'=>'الاسكندرية'],
            ['id'=>4,'name'=>'الاسماعلية'],
            ['id'=>5,'name'=>'اسوان'],
            ['id'=>6,'name'=>'اسيوط'],
            ['id'=>7,'name'=>'الاقصر'],
            ['id'=>8,'name'=>'سوهاج'],
            ['id'=>9,'name'=>'قنا'],
            ['id'=>10,'name'=>'البحيرة'],
            ['id'=>11,'name'=>'البحر الاحمر'],
            ['id'=>12,'name'=>'بنى سويف'],
            ['id'=>13,'name'=>'بورسعيد'],
            ['id'=>14,'name'=>'جنوب سينا'],
            ['id'=>15,'name'=>'الدقهلية'],
            ['id'=>16,'name'=>'دمياط'],
            ['id'=>17,'name'=>'الشرقية'],
            ['id'=>18,'name'=>'شمال سينا'],
            ['id'=>19,'name'=>'الغربية'],
            ['id'=>20,'name'=>'الفيوم'],
            ['id'=>21,'name'=>'القليوبية'],
            ['id'=>22,'name'=>'كفر الشيخ'],
            ['id'=>23,'name'=>'مطروح'],
            ['id'=>24,'name'=>'المنوفية'],
            ['id'=>25,'name'=>'الوادى الجديد'],
            ['id'=>27,'name'=>'السويس'],
            ['id'=>28,'name'=>'المنيا'],
        ];
        Country::insert($countriesRecords);
    }
}
