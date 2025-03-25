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
        Schema::create('cooker_charge', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_type', 20)->nullable()->comment('المستخدم');
            $table->bigInteger('cooker_id')->unsigned()->comment('الطباخ');
            $table->bigInteger('user_id')->unsigned()->comment('العميل');
            $table->bigInteger('admin_id')->unsigned()->comment('بواسطة');
            $table->string('image')->nullable()->comment('صورة الشحن');
            $table->float('price',8,2)->default(0)->comment('القيمة');
            $table->enum('status_of',['wait', 'accpet', 'refused'])->default('wait')->comment('حالة الشحن');
            $table->string('resonse')->nullable()->comment('اسباب ');
            $table->timestamps();

            $table->foreign('cooker_id')->references('id')->on('cookers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('admin_id')->references('id')->on('admins');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cooker_charge');
    }
};
