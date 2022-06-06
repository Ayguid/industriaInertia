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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable();
            // se complica hacer el cascade delete porque puede ser cuando se borra un usuario, o un entity...
            //pensarla, manejar el cascade delete desde el controlaror
            $table->nullableMorphs('model');
            $table->foreignId('user_id');
            $table->string('title')->nullable();
            $table->string('content');
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
        Schema::dropIfExists('posts');
    }
};
