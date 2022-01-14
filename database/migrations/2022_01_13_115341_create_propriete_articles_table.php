<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProprieteArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propriete_articles', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->boolean('estObligatoire')->default(1);
            $table->foreignId('type_article_id')->constrained()->onDelete('cascade');
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
        Schema::table('type_propriete_articles', function(Blueprint $table){
            $table->dropForeign('type_article_id_foreign');
        });
        Schema::dropIfExists('type_propriete_articles');
    }
}
