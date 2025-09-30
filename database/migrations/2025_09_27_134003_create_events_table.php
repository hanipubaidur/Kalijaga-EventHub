<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('gambar')->nullable(); // path gambar
            $table->text('deskripsi');
            $table->dateTime('tanggal');
            $table->string('lokasi')->nullable();
            $table->unsignedBigInteger('kategory_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('kategory_id')->references('id')->on('kategories')->onDelete('cascade');

           // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
