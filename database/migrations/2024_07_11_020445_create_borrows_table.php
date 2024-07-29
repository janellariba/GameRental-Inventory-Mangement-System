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
        Schema::create('borrows', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->string('customer_name');
            $table->string('customer_address');
            $table->string('customer_email');
            $table->string('customer_number');
            $table->string('brw_item_name');
            $table->string('brw_item_brand');
            $table->string('brw_item_category');
            $table->integer('brw_quantity');
            $table->integer('brw_duration');
            $table->date('date_requested');
            $table->date('date_to_return');
            $table->string('borrow_status');
            $table->string('late_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrows');
    }
};
