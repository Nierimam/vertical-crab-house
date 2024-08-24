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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')
            ->references('id')
            ->on('customers')
            ->onDelete('cascade');

            $table->string('invoice',50);
            $table->string('total_sebelum_discount',30);
            $table->string('total',30);
            $table->string('status',30);
            $table->text('alamat');
            $table->string('long',100);
            $table->string('lat',100);
            $table->string('voucher',100)->nullable();
            $table->string('type_voucher',100)->nullable();
            $table->string('discount',100)->nullable();
            $table->string('nominal_discount',100)->nullable();
            $table->string('shipping_courier',100)->nullable();
            $table->string('shipping_price',100)->nullable();
            $table->string('nama_bank',100)->nullable();
            $table->string('no_bank',100)->nullable();
            $table->string('pemilik_bank',100)->nullable();
            $table->dateTime('tanggal_bayar')->nullable();

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
        Schema::dropIfExists('orders');
    }
};
