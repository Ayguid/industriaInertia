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
        Schema::create('entity_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade'); // para que se borren los entity_categories si se borra una categoria
            $table->foreignId('entity_id')->nullable()
                ->references('id')->on('entities')
                ->onDelete('cascade'); // para que se borren los entity_categories si se borra un entity
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
        Schema::dropIfExists('entity_categories');
    }
};
