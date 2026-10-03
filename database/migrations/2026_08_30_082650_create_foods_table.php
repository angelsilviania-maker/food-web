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
        Schema::create('foods', function (Blueprint $table) {
            $table->id(); //primary key
            $table->string('name');
            $table->string('category'); // Diubah jadi string agar bisa nerima 'Favorit', dll.
            $table->integer('price');
            $table->text('description');
            $table->string('image')->nullable(true); //boleh kosong
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};