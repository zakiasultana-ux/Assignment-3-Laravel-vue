<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageUrlToCharactersAndEpisodes extends Migration
{
    /**
     * Add image_url column to characters and episodes tables.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->string('image_url')->nullable()->after('catchphrase');
        });

        Schema::table('episodes', function (Blueprint $table) {
            $table->string('image_url')->nullable()->after('director');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->dropColumn('image_url');
        });

        Schema::table('episodes', function (Blueprint $table) {
            $table->dropColumn('image_url');
        });
    }
}
