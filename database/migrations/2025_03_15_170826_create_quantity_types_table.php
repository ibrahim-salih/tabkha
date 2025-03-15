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
        Schema::create('quantity_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->comment('اسم الطبخة');
            $table->string('slug')->nullable()->comment('سلوج');
            $table->enum('status',[0,1])->default(0)->comment('حالة التفعيل');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quantity_types');
    }
};
