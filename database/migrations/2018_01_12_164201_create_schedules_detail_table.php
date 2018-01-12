<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesDetailTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('schedules_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('schedule_id');
            $table->integer('day')->nullable();
            $table->integer('product_id')->nullable();
            $table->time('hour')->nullable();
            $table->time('hour_end')->nullable();
            $table->integer('duration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('schedules_detail');
    }

}
