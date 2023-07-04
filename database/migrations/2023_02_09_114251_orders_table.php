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
      $table->charset = 'utf8mb4';
      $table->collation = 'utf8mb4_unicode_ci';
      
      $table->id();
      $table->string('order_no')->unique();
      $table->unsignedBigInteger('user_id')->nullable();
      $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
      $table->string('fname')->nullable();
      $table->string('lname')->nullable();
      $table->string('cname')->nullable();
      $table->unsignedBigInteger('trn_no')->nullable();
      $table->string('email');
      $table->string('phone');
      $table->string('altphone')->nullable();
      $table->longText('address');
      $table->unsignedBigInteger('city_id')->nullable();
      $table->foreign('city_id')->references('id')->on('cities')->onDelete('SET NULL');
      $table->string('landmark')->nullable();
      $table->enum('status', ['new', 'processed', 'completed', 'cancelled', 'returned'])->default('new');
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
