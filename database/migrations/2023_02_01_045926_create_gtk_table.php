<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGTKTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gtk', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('sampul')->nullable();
            $table->string('slug');
            $table->unsignedBigInteger('gtk_jabatan_id')->nullable();

            $table->foreign('gtk_jabatan_id')->references('id')->on('gtk_jabatan')->onDelete('set null');
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
        Schema::dropIfExists('gtk');
    }
}
