<?php

namespace Database\Seeders;

use App\Models\Foodlist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $records = [
            ['id'=>1,'section_id'=>1,'category_id'=>2,'name'=>'كرنب','slug'=>'كرنب','status'=>'1'],
            ['id'=>2,'section_id'=>1,'category_id'=>2,'name'=>'ورق عنب','slug'=>'ورق-عنب','status'=>'1'],
            ['id'=>3,'section_id'=>1,'category_id'=>2,'name'=>'كوسة','slug'=>'كوسة','status'=>'1'],
            ['id'=>4,'section_id'=>1,'category_id'=>2,'name'=>'بتنجان','slug'=>'بتنجان','status'=>'1'],
            ['id'=>5,'section_id'=>1,'category_id'=>2,'name'=>'طماطم','slug'=>'طماطم','status'=>'1'],
            ['id'=>6,'section_id'=>1,'category_id'=>2,'name'=>'بصل','slug'=>'بصل','status'=>'1'],
            ['id'=>7,'section_id'=>1,'category_id'=>2,'name'=>'خص','slug'=>'خص','status'=>'1'],

            ['id'=>8,'section_id'=>1,'category_id'=>1,'name'=>'فراخ','slug'=>'فراخ','status'=>'1'],
            ['id'=>9,'section_id'=>1,'category_id'=>1,'name'=>'لحمة','slug'=>'لحمة','status'=>'1'],
            ['id'=>10,'section_id'=>1,'category_id'=>1,'name'=>'سمك','slug'=>'سمك','status'=>'1'],
            ['id'=>11,'section_id'=>1,'category_id'=>1,'name'=>'كفتة','slug'=>'كفتة','status'=>'1'],
            ['id'=>12,'section_id'=>1,'category_id'=>1,'name'=>'طرب','slug'=>'طرب','status'=>'1'],

            ['id'=>13,'section_id'=>1,'category_id'=>3,'name'=>'ملوخية','slug'=>'ملوخية','status'=>'1'],
            ['id'=>14,'section_id'=>1,'category_id'=>3,'name'=>'بطاطس','slug'=>'بطاطس','status'=>'1'],
            ['id'=>15,'section_id'=>1,'category_id'=>3,'name'=>'فاصوليا بيضاء','slug'=>'فاصوليا-بيضاء','status'=>'1'],
            ['id'=>16,'section_id'=>1,'category_id'=>3,'name'=>'فاصوليا خضراء','slug'=>'فاصوليا-خضراء','status'=>'1'],
            ['id'=>17,'section_id'=>1,'category_id'=>3,'name'=>'لوبيا','slug'=>'لوبيا','status'=>'1'],
            ['id'=>18,'section_id'=>1,'category_id'=>3,'name'=>'كوسه','slug'=>'كوسه','status'=>'1'],
            ['id'=>19,'section_id'=>1,'category_id'=>3,'name'=>'باميه','slug'=>'باميه','status'=>'1'],
            ['id'=>20,'section_id'=>1,'category_id'=>3,'name'=>'سبانخ','slug'=>'سبانخ','status'=>'1'],
            ['id'=>21,'section_id'=>1,'category_id'=>3,'name'=>'خبيزة','slug'=>'خبيزة','status'=>'1'],
            ['id'=>22,'section_id'=>1,'category_id'=>3,'name'=>'قلقاس','slug'=>'قلقاس','status'=>'1'],

            ['id'=>23,'section_id'=>1,'category_id'=>3,'name'=>'فتة','slug'=>'فتة','status'=>'1'],
            ['id'=>24,'section_id'=>1,'category_id'=>3,'name'=>'شوربة عدس','slug'=>'شوربة-عدس','status'=>'1'],
            ['id'=>25,'section_id'=>1,'category_id'=>3,'name'=>'شوربة خضار','slug'=>'شوربة-خضار','status'=>'1'],
            ['id'=>26,'section_id'=>1,'category_id'=>3,'name'=>'بسارة','slug'=>'بسارة','status'=>'1'],

            ['id'=>27,'section_id'=>1,'category_id'=>6,'name'=>'ارز محمر','slug'=>'ارز-محمر','status'=>'1'],
            ['id'=>28,'section_id'=>1,'category_id'=>6,'name'=>'ارز بسمتى','slug'=>'ارز-بسمتى','status'=>'1'],
            ['id'=>29,'section_id'=>1,'category_id'=>7,'name'=>'مكرونة محمرة','slug'=>'مكرونة-محمرة','status'=>'1'],
            ['id'=>30,'section_id'=>1,'category_id'=>7,'name'=>'مكرونة بالصلصة','slug'=>'مكرونة-بالصلصة','status'=>'1'],

            ['id'=>31,'section_id'=>1,'category_id'=>7,'name'=>'مكرونة بالبشاميل','slug'=>'مكرونة-بالبشاميل','status'=>'1'],
            ['id'=>32,'section_id'=>1,'category_id'=>4,'name'=>'جلاش باللحمة المفرومة','slug'=>'جلاش-باللحمة-المفرومة','status'=>'1'],
            ['id'=>33,'section_id'=>1,'category_id'=>4,'name'=>'رقاق','slug'=>'رقاق','status'=>'1'],

            ['id'=>34,'section_id'=>1,'category_id'=>5,'name'=>'سجق','slug'=>'سجق','status'=>'1'],
            ['id'=>35,'section_id'=>1,'category_id'=>5,'name'=>'كرشة','slug'=>'كرشة','status'=>'1'],
            ['id'=>36,'section_id'=>1,'category_id'=>5,'name'=>'كوراع','slug'=>'كوراع','status'=>'1'],

            ['id'=>37,'section_id'=>1,'category_id'=>4,'name'=>'سمك مقلى','slug'=>'سمك-مقلى','status'=>'1'],
            ['id'=>38,'section_id'=>1,'category_id'=>4,'name'=>'سمك صينية','slug'=>'سمك-صينية','status'=>'1'],
        ];
        Foodlist::insert($records);
    }
}
