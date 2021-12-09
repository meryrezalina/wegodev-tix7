<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArrangeMovieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arrange_movie', function (Blueprint $table) {
            $table->id();
            $table->string('studio');
            $table->integer('price');
            $table->json('seats');
            $table->json('schedules');
            $table->enum('status', ['coming soon', 'in theater']);
            $table->foreignId('theater_id')->constrained('theaters');
            $table->foreignId('movie_id')->constrained('movies');


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
        Schema::dropIfExists('arrange_movie');
    }
}