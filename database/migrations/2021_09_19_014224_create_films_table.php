<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('title');
            $table->unsignedBigInteger('genre_id');
            $table->text('description');
            $table->double('price');
            $table->string('status')->default('Available for sale');
            $table->timestamps();

            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('films');
    }
}
