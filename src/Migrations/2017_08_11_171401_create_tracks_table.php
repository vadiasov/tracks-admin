<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('album_id')->unsigned();
            $table->foreign('album_id')
                ->references('id')->on('albums')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('title', 100)->nullable();
            $table->date('release_date')->nullable();
            $table->decimal('price', 5, 2)->nullable();
            $table->string('free', 1)->nullable();
            $table->string('donate', 1)->nullable();
            $table->string('genres', 100)->nullable();
            $table->text('about')->nullable();
            $table->string('file', 50);
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
        Schema::dropIfExists('tracks');
    }
}
