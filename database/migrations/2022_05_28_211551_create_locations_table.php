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
        //
        Schema::create('location_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()
                ->constrained('location_types')
                ->onDelete('cascade'); // esto es para borrar los childs en un pase
            $table->string('name');
            $table->timestamps();
        });
        //
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id');
            $table->foreignId('parent_id')->nullable()
                ->constrained('locations')
                ->onDelete('cascade'); // esto es para borrar los childs en un pase
            $table->string('name');
            $table->string('code')->nullable();
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();
            $table->string('postal_code')->nullable();
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
        Schema::dropIfExists('location_types');
        Schema::dropIfExists('locations');
    }
};
