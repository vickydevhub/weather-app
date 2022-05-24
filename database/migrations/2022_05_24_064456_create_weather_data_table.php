<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeatherDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_data', function (Blueprint $table) {
            $table->id();
            $table->string('location_name', 100);
            $table->string('lat', 100);
            $table->string('lon', 100);
            $table->string('weather_main', 100);
            $table->string('weather_description', 100);
            $table->integer('weather_id');
            $table->decimal('temp',8,  2);
            $table->decimal('feels_like',8,  2);
            $table->decimal('temp_min',8,  2);
            $table->decimal('temp_max',8,  2);
            $table->integer('pressure');
            $table->integer('humidity');
            $table->integer('visibility');
            $table->decimal('wind_speed',8,  2);
            $table->integer('wind_deg');
            $table->dateTime('datetime');
            $table->dateTime('sunrise');
            $table->dateTime('sunset');
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
        Schema::dropIfExists('weather_data');
    }
}
