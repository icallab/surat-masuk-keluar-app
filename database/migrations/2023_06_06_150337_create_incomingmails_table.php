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
        Schema::create('incomingmails', function (Blueprint $table) {
            $table->id();
            $table->string('no_sm');
            $table->string('judul_sm');
            $table->unsignedBigInteger('id_type');
            $table->string('asal_surat');
            $table->date('tgl_masuk');
            $table->string('perihal_sm');
            $table->string('file_sm');
            $table->text('isi_sm');
            $table->unsignedBigInteger('pengirim_sm');
            $table->enum('mark', ['read','unread']);
            $table->timestamps();

            $table->foreign('id_type')->references('id')->on('types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pengirim_sm')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomingmails');
    }
};
