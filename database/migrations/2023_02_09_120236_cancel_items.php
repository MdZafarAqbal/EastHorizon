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
    Schema::create('cancel_items', function (Blueprint $table) {
      $table->charset = 'utf8mb4';
      $table->collation = 'utf8mb4_unicode_ci';
      
      $table->id();
      $table->unsignedBigInteger('order_id');
      $table->foreign('order_id')->references('id')->on('orders')->onDelete('CASCADE');
      $table->unsignedBigInteger('product_id')->nullable();
      $table->foreign('product_id')->references('id')->on('products')->onDelete('SET NULL');
      $table->string('form')->nullable();
      $table->string('size');
      $table->float('price');
      $table->integer('quantity');
      $table->float('discount')->nullable();
      $table->float('total');
      $table->string('reason')->nullable();
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
    Schema::dropIfExists('cancel_items');
  }
};
