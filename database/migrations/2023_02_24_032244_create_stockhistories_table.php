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
        Schema::create('stockhistories', function (Blueprint $table) {
            $table->id('itemid');
            $table->string('category');
            $table->string('name');
            $table->string('movement');
            $table->integer('movement_quantity');
            $table->string('housekeeper');
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
        Schema::dropIfExists('stockhistories');
    }
};