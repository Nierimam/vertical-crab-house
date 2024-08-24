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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('tempat_lahir',100)->nullable()->change();
            $table->dateTime('tanggal_lahir')->nullable()->change();
            $table->text('img_profile')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('tempat_lahir',100);
            $table->dateTime('tanggal_lahir');
            $table->text('img_profile');
        });
    }
};
