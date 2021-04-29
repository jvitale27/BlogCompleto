<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('tag_id');

             $table->foreign('post_id')
                ->references('id')->on('posts')               //clave foranea con id de tabla posts
                ->onDelete('cascade');      //si elimino un registro de la tabla posts me elimina los registros de esta tabla que tienen la correspondiente clave foranea eliminada

             $table->foreign('tag_id')
                ->references('id')->on('tags')               //clave foranea con id de tabla tags
                ->onDelete('cascade');      //si elimino un registro de la tabla tags me elimina los registros de esta tabla que tienen la correspondiente clave foranea eliminada

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
        Schema::dropIfExists('post_tag');
    }
}
