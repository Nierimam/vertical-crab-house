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
        Schema::create('dummy_data', function (Blueprint $table) {
            $table->id();
            $table->float('do');
            $table->float('tds');
            $table->float('amonia');
            $table->float('suhu');
            $table->float('salinitas');
            $table->float('ph');
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
        Schema::dropIfExists('dummy_data');
    }
};
