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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('qty');
            $table->float('sale_price',10,2);
            $table->float('remaining_amount',10,2);
            $table->float('paid _amount',10,2);
            $table->float('discount',10,2)->default(0);
            $table->float('total',10,2);
            $table->string('payment_method',50);
            $table->string('payment_status',50);
            $table->foreign('user_id')->references('id')->on('users')->comments('user is Acutally customer id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('users')->comments('user is Acutally Vendor id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
