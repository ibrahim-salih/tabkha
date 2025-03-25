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
        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type', 20)->nullable()->comment('جروب');
            $table->string('title', 30)->nullable()->comment('عنوان الباقة');
            $table->string('days', 5)->comment('عدد الايام');
            $table->text('description')->nullable()->comment('وصف الباقة');
            $table->float('price',8,2)->default(0)->comment('السعر');
            $table->enum('status',[0,1])->default(0)->comment('حالة القسم');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
