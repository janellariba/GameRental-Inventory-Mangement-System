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
        Schema::create('histories', function (Blueprint $table) {
            $table->id('history_id');
            $table->string('transaction_id');
            $table->string('history_cus_name');
            $table->string('history_cus_add');
            $table->string('history_cus_email');
            $table->string('history_cus_no');
            $table->string('history_item');
            $table->string('history_brand');
            $table->string('history_category');
            $table->string('history_quantity');
            $table->string('history_duration');
            $table->string('history_pickup');
            $table->string('history_returned');
            $table->string('history_remarks');
            $table->string('history_note')->nullable();
            $table->string('history_late')->nullable();
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
