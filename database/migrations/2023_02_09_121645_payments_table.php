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
    Schema::create('payments', function (Blueprint $table) {
      $table->charset = 'utf8mb4';
      $table->collation = 'utf8mb4_unicode_ci';
      
      $table->id();
      $table->unsignedBigInteger('order_id')->nullable();
      $table->foreign('order_id')->references('id')->on('orders')->onDelete('SET NULL');
      $table->string('account_name')->nullable();
      $table->string('charge_id')->nullable();
      $table->unsignedBigInteger('account_no')->nullable();
      $table->enum('method', ['cod', 'op'])->default('cod');
      $table->enum('status', ['paid', 'unpaid'])->default('unpaid');
      $table->float('subtotal');
      $table->float('tax');
      $table->float('shipping')->nullable();
      $table->float('discount')->nullable();
      $table->float('cancelled')->nullable();
      $table->float('returned')->nullable();
      $table->float('refund')->nullable();
      $table->float('total');
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
