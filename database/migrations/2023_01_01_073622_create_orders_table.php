<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->double('lat');
            $table->double('long');
            $table->foreignId('market_id')->references('id')->on('markets')->cascadeOnDelete();
            $table->string('order_details');
            $table->string('address_name')->nullable();
            $table->string('distance');
            $table->string('price');
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('driver_id')->references('id')->on('users')->cascadeOnDelete()->nullable();
            $table->string('status_order');
            $table->text('cancelation_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
