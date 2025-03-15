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
        Schema::create('foodlists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('section_id')->unsigned()->comment('القسم');
            $table->bigInteger('category_id')->unsigned()->comment('التصنيف');
            $table->string('name')->nullable()->comment('اسم الطبخة');
            $table->string('slug')->nullable()->comment('سلوج');
            $table->enum('status',[0,1])->default(0)->comment('حالة التفعيل');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('section_id')->references('id')->on('sections');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foodlists');
    }
};
