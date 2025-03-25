<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $citesRecords = [
            ['id'=>1,'state_id'=>44,'name'=>'العزيزية'],
            ['id'=>2,'state_id'=>44,'name'=>'ميت رهينة'],
            ['id'=>3,'state_id'=>44,'name'=>'أبو رجوان بحري'],
            ['id'=>4,'state_id'=>44,'name'=>'أبو رجوان قبلي'],
            ['id'=>5,'state_id'=>44,'name'=>'دهشور'],
            ['id'=>6,'state_id'=>44,'name'=>' زاوية دهشور'],
            ['id'=>7,'state_id'=>44,'name'=>'منشأة دهشور'],
            ['id'=>8,'state_id'=>44,'name'=>'مزغونة'],
            ['id'=>9,'state_id'=>44,'name'=>'منشأة كاسب'],
            ['id'=>10,'state_id'=>44,'name'=>'المرازيق'],
            ['id'=>11,'state_id'=>44,'name'=>'كفر زهران'],
            ['id'=>12,'state_id'=>44,'name'=>'الشناب'],
            ['id'=>13,'state_id'=>44,'name'=>'الطرفاية'],
            ['id'=>14,'state_id'=>44,'name'=>'قلعة المرازيق'],
            ['id'=>15,'state_id'=>44,'name'=>'الشوبك الغربي'],
            ['id'=>16,'state_id'=>44,'name'=>' نزلة الشوبك'],
            ['id'=>17,'state_id'=>44,'name'=>'ابوصير'],
            ['id'=>18,'state_id'=>44,'name'=>'سقارة'],
            ['id'=>19,'state_id'=>40,'name'=>'الحوامدية'],
            ['id'=>20,'state_id'=>40,'name'=>'أم خنان'],
            ['id'=>21,'state_id'=>40,'name'=>'الشيخ عثمان'],
            ['id'=>22,'state_id'=>39,'name'=>'ناهيا'],
            ['id'=>23,'state_id'=>39,'name'=>'المعتمدية'],
            ['id'=>24,'state_id'=>39,'name'=>'كفر حكيم'],
            ['id'=>25,'state_id'=>39,'name'=>'أبو رواش'],
            ['id'=>26,'state_id'=>39,'name'=>'برك الخيام'],
            ['id'=>27,'state_id'=>39,'name'=>'عزبة العسيلي'],
            ['id'=>28,'state_id'=>39,'name'=>'كومبرة'],
            ['id'=>29,'state_id'=>39,'name'=>'بني مجدول'],
            ['id'=>30,'state_id'=>39,'name'=>'صفط اللبن'],
            ['id'=>31,'state_id'=>42,'name'=>'الكداية'],
            ['id'=>32,'state_id'=>42,'name'=>'القبابات'],
            ['id'=>33,'state_id'=>42,'name'=>'كفر قنديل'],
            ['id'=>34,'state_id'=>42,'name'=>'البرميل'],
            ['id'=>35,'state_id'=>42,'name'=>'منيل السلطان'],
            ['id'=>36,'state_id'=>42,'name'=>'صول'],
            ['id'=>37,'state_id'=>43,'name'=>'ابو النمرس'],
            ['id'=>38,'state_id'=>43,'name'=>'ترسا'],
            ['id'=>39,'state_id'=>43,'name'=>'عزبة مدكور'],
            ['id'=>40,'state_id'=>43,'name'=>'الحرانية'],
            ['id'=>41,'state_id'=>43,'name'=>'نزلة الاشطر'],
            ['id'=>42,'state_id'=>43,'name'=>'شبرامنت'],
            ['id'=>43,'state_id'=>43,'name'=>'زاوية ابو مسلم'],
            ['id'=>44,'state_id'=>43,'name'=>'بنى يوسف'],
            ['id'=>45,'state_id'=>43,'name'=>'ميت قادوس'],
            ['id'=>46,'state_id'=>43,'name'=>'ميت شماسى'],
            ['id'=>47,'state_id'=>43,'name'=>'المنوات'],
            ['id'=>48,'state_id'=>43,'name'=>'منيل شيحة'],
            ['id'=>49,'state_id'=>43,'name'=>'طموة'],
            ['id'=>50,'state_id'=>46,'name'=>'البحاروة'],
            ['id'=>51,'state_id'=>46,'name'=>'الستين'],
            ['id'=>52,'state_id'=>46,'name'=>'قوت القلوب'],
            ['id'=>53,'state_id'=>47,'name'=>'الصف البلد'],
            ['id'=>54,'state_id'=>48,'name'=>'أوسيم'],
            ['id'=>55,'state_id'=>48,'name'=>'برطس'],
            ['id'=>56,'state_id'=>48,'name'=>'صيدا'],
            ['id'=>57,'state_id'=>48,'name'=>'سقيل'],
            ['id'=>58,'state_id'=>48,'name'=>'طناش'],
            ['id'=>59,'state_id'=>48,'name'=>'نزلة الزمر'],
            ['id'=>60,'state_id'=>48,'name'=>'جزيرة محمد'],
            ['id'=>61,'state_id'=>48,'name'=>'وراق العرب'],
            ['id'=>62,'state_id'=>48,'name'=>'بشتيل'],
            ['id'=>63,'state_id'=>48,'name'=>'البراجيل'],
            ['id'=>64,'state_id'=>48,'name'=>'الكوم الاحمر'],
            ['id'=>65,'state_id'=>48,'name'=>'شنبارى'],
            ['id'=>66,'state_id'=>48,'name'=>'الزيدية'],
            ['id'=>67,'state_id'=>48,'name'=>'محمود عبدالصمد'],
        ];
        City::insert($citesRecords);
    }
}
