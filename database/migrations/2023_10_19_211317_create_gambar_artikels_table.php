<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGambarArtikelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gambar_artikel', function (Blueprint $table) {
            $table->id();
            $table->uuid('gambar_id');
            $table->unsignedBigInteger('artikel_id');

            $table->foreign('gambar_id')->references('id')->on('gambar')->onDelete('cascade');
            $table->foreign('artikel_id')->references('id')->on('artikel')->onDelete('cascade');
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
        Schema::dropIfExists('gambar_artikel');
    }
}
