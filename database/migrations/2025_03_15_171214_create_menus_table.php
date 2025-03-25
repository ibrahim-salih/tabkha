<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('section_id')->unsigned()->comment('القسم');
            $table->bigInteger('category_id')->unsigned()->comment('التصنيف');
            $table->bigInteger('food_id')->unsigned()->comment('الطبخة');
            $table->bigInteger('cooker_id')->unsigned()->comment('الطباخ');
            $table->bigInteger('Qtype_id')->unsigned()->comment('نوع الكمية');
            $table->bigInteger('country_id')->unsigned()->comment('المحافظة');
            $table->bigInteger('state_id')->unsigned()->comment('المدينة');
            $table->string('image')->nullable()->comment('صورة');
            $table->text('description')->nullable()->comment('وصف الطبخة');
            $table->string('video')->nullable()->comment('فيديو الطبخة');
            $table->float('price',8,2)->default(0)->comment('السعر');
            $table->integer('minQty',10)->nullable()->comment('اقل كمية للطلب');
            $table->integer('bforeOrder',10)->nullable()->comment('يطلب قبل التنفيذ بـ');
            $table->integer('timeEnd',10)->nullable()->comment('وقت التنفيذ');
            $table->enum('status',[0,1])->default(0)->comment('حالة التفعيل');
            $table->bigInteger('view')->default(0)->comment('مشاهدات الطبخة');
            $table->text('meta_description')->nullable()->comment('كلمات مفتاحية');
            $table->text('meta_keywords')->nullable()->comment('كلمات مفتاحية');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('section_id')->references('id')->on('sections');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('food_id')->references('id')->on('foodlists');
            $table->foreign('cooker_id')->references('id')->on('cookers');
            $table->foreign('Qtype_id')->references('id')->on('quantity_types');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('state_id')->references('id')->on('states');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
