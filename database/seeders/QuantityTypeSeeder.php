<?php

namespace Database\Seeders;

use App\Models\QuantityType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuantityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $records = [
            ['id'=>1,'name'=>'كيلو','slug'=>'كيلو','status'=>'1'],
            ['id'=>2,'name'=>'طاجن','slug'=>'طاجن','status'=>'1'],
            ['id'=>3,'name'=>'قطعة','slug'=>'قطعة','status'=>'1'],
            ['id'=>4,'name'=>'طبق','slug'=>'طبق','status'=>'1'],
            ['id'=>5,'name'=>'علبة','slug'=>'علبة','status'=>'1'],
            ['id'=>6,'name'=>'وجبة','slug'=>'وجبة','status'=>'1'],
            ['id'=>7,'name'=>'صينية','slug'=>'صينية','status'=>'1'],
            ['id'=>8,'name'=>'سندوتش','slug'=>'سندوتش','status'=>'1'],
            ['id'=>9,'name'=>'رغيف','slug'=>'رغيف','status'=>'1'],

        ];
        QuantityType::insert($records);
    }
}
