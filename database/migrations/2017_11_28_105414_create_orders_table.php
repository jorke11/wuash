<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('status_id');
            $table->integer('type_vehicle_id');
            $table->text('services');
            $table->dateTime('created');
            $table->date('day');
            $table->time('hour');
            $table->text('plate');
            $table->dateTime('leaved')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('orders');
    }

}
