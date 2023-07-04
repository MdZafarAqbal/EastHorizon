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
    Schema::create('users', function (Blueprint $table) {
      $table->charset = 'utf8mb4';
      $table->collation = 'utf8mb4_unicode_ci';

      $table->id();
      $table->string('fname', 100)->nullable();
      $table->string('lname', 100)->nullable();
      $table->string('cname', 100)->nullable();
      $table->bigInteger('trn_no')->unique()->nullable();
      $table->string('email', 100)->unique()->nullable();
      $table->string('password');
      $table->enum('role',['admin','user', 'manager'])->default('user');
      $table->enum('status',['active','inactive'])->default('active');
      $table->rememberToken()->nullable();
      $table->timestamp('email_verified_at')->nullable();
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
    Schema::dropIfExists('users');
  }
};
