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
        Schema::create('entities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by_user_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name');
            $table->string('username')->unique()->nullable();;
            $table->string('email')->nullable();
            $table->string('description')->nullable();
            $table->string('cuit')->nullable();
            $table->string('cuil')->nullable();
            $table->string('founded_date')->nullable();
            $table->string('employee_count')->nullable();
            //$table->unsignedBigInteger('location_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('street')->nullable();
            $table->string('street_number')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('phone')->nullable();;
            $table->string('cellphone')->nullable();
            $table->string('profile_photo_path')->nullable();
            $table->string('background_photo_path')->nullable();
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
        Schema::dropIfExists('entities');
    }
};
