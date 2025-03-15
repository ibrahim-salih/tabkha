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
        Schema::create('cookers', function (Blueprint $table) {
            $table->id();
            $table->string('f_name',60)->nullable()->comment('الاسم');
            $table->string('l_name',40)->nullable()->comment('اللقب');
            $table->string('username')->unique()->comment('اسم المطبخ');
            $table->enum('gender', ['Male', 'Female'])->nullable()->comment('الجنس');
            $table->string('email',200)->unique()->comment('الايميل');
            $table->string('phone',15)->unique()->nullable()->comment('الموبايل');
            $table->bigInteger('nationalty_id')->unsigned()->comment('الجنسية');
            $table->bigInteger('country_id')->unsigned()->comment('المحافظة');
            $table->bigInteger('state_id')->unsigned()->comment('المدينة');
            $table->string('address',160)->nullable()->comment('العنوان');
            $table->string('image',100)->nullable()->comment('صورة شخصية');
            $table->string('ID_img_front',100)->nullable()->comment('سيلفى البطاقة وش');
            $table->string('ID_img_back',100)->nullable()->comment('سيلفى البطاقة ظهر');
            $table->string('password',100);
            $table->timestamp('last_seen')->nullable()->comment('اخر دخول');
            $table->enum('status',[0,1])->default(0)->comment('حالة التفعيل');
            $table->enum('confirm',[0,1])->default(0)->comment('تنشيط');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('nationalty_id')->references('id')->on('nationalities');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('state_id')->references('id')->on('states');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cooker');
    }
};
