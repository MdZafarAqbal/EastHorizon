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
        Schema::create('repairs', function (Blueprint $table) {
            $table->id();
            $table->string('user_name')->nullable();
            $table->unsignedBigInteger('mobile_no')->nullable();
            $table->string('email_id')->nullable();
            $table->string('product_name')->nullable();
            $table->unsignedBigInteger('serial_no')->nullable();
            $table->unsignedBigInteger('imei_no')->nullable();
            $table->string('problem')->nullable();
            $table->string('images')->nullable();
            $table->integer('charge')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('inactive');
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
        Schema::dropIfExists('repairs');
    }
};
