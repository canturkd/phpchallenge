<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('device_id');
            $table->unsignedInteger('app_id');
            $table->integer('price');
            $table->string('currency');
            $table->integer('status'); // 1 : success, 2 : failed
            $table->timestamps();

            $table->foreign('device_id')->references('id')->on('devices');
            $table->foreign('app_id')->references('id')->on('applications');

            $table->index('device_id');
            $table->index('app_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_payments');
    }
}
