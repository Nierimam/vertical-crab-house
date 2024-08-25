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
        Schema::create('order_produks', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')
            ->references('id')
            ->on('orders')
            ->onDelete('cascade');
            $table->unsignedBigInteger('produk_variant_id');
            $table->foreign('produk_variant_id')
            ->references('id')
            ->on('produk_variants')
            ->onDelete('cascade');

            $table->string('qty',30);
            $table->string('total',30);
            $table->string('rating',30)->nullable();
            $table->text('review')->nullable();
            $table->text('media')->nullable();

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
        Schema::dropIfExists('order_produks');
    }
};
