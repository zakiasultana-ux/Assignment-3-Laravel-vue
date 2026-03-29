<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('season_number');
            $table->integer('episode_number');
            $table->text('description')->nullable();
            $table->integer('air_year')->nullable();
            $table->decimal('imdb_rating', 3, 1)->nullable();
            $table->string('director')->nullable();
            $table->bigInteger('featured_character_id')->unsigned()->nullable();
            $table->foreign('featured_character_id')->references('id')->on('characters')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episodes');
    }
}
