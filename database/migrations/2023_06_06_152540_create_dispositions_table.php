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
        Schema::create('dispositions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_sm');
            $table->unsignedBigInteger('kepada');
            $table->text('isi_disposisi');
            $table->enum('mark', ['read','unread']);
            $table->timestamps();

            $table->foreign('id_sm')->references('id')->on('incomingmails')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kepada')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispositions');
    }
};
