<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug');
            $table->text('extract')->nullable();            //en status borrador puede estar vacio. 1 to 65,535
            $table->longText('body')->nullable();           //en status borrador puede estar vacio. 1 to 4,294,967,295
            $table->enum('status', [1, 2])->default(1);    //1 borrador, 2 publicado
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');

             $table->foreign('user_id')
                ->references('id')->on('users')               //clave foranea con id de tabla users
                ->onDelete('cascade')      //si elimino un registro de la tabla users me elimina los registros de esta tabla que tienen la correspondiente clave foranea eliminada
                ->onUpdate('cascade');      //un cambio de id en users se actualiza autom. en user_id de esta tabla

             $table->foreign('category_id')
                ->references('id')->on('categories')               //clave foranea con id de tabla categories
                ->onDelete('cascade')      //si elimino un registro de la tabla categories me elimina los registros de esta tabla que tienen la correspondiente clave foranea eliminada
                ->onUpdate('cascade');      //un cambio de id en users se actualiza autom. en user_id de esta tabla

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
        Schema::dropIfExists('posts');
    }
}
