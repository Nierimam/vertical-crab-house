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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('nama',50);
            $table->text('deskripsi');
            $table->string('telp',30);
            $table->text('visi');
            $table->text('misi');
            $table->text('alamat');
            $table->text('facebook');
            $table->text('instagram');
            $table->text('linkedin');
            $table->text('tiktok');
            $table->text('shopee');
            $table->text('tokopedia');
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
        Schema::dropIfExists('companies');
    }
};
