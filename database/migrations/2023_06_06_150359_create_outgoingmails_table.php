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
        Schema::create('outgoingmails', function (Blueprint $table) {
            $table->id();
            $table->string('no_sk');
            $table->string('judul_sk');
            $table->unsignedBigInteger('id_type');
            $table->string('tujuan_surat');
            $table->date('tgl_keluar');
            $table->string('perihal_sk');
            $table->string('file_sk');
            $table->text('isi_sk');
            $table->unsignedBigInteger('pengirim_sk');
            $table->enum('status', ['belum', 'sudah'])->default('belum');
            $table->enum('keterangan',['0','1'])->default(null);
            $table->timestamps();
            
            $table->foreign('id_type')->references('id')->on('types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pengirim_sk')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outgoingmails');
    }
};
