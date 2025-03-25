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
        Schema::create('cooker_charge_value', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_type', 20)->nullable()->comment('المستخدم');
            $table->bigInteger('cooker_id')->unsigned()->comment('الطباخ');
            $table->bigInteger('user_id')->unsigned()->comment('العميل');
            $table->float('charge',8,2)->default(0)->comment('الرصيد الحالى');
            $table->float('total_charge',8,2)->default(0)->comment('اجمالى الرصيد المشحون ');
            $table->float('total_use',8,2)->default(0)->comment('اجمالى الرصيد المستخدم ');
            $table->timestamps();

            $table->foreign('cooker_id')->references('id')->on('cookers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cooker_charge_value');
    }
};
