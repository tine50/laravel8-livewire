<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->dateTime('dateDebut');
            $table->dateTime('dateFin');
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('statut_location_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('type_propriete_locations', function(Blueprint $table){
            $table->dropForeign(['client_id', 'statut_location_id', 'user_id']);
        });
        Schema::dropIfExists('type_propriete_locations');
    }
}
