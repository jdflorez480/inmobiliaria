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
        Schema::create('inmueble_imagens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inmueble_id')->constrained('inmuebles')->onDelete('cascade');
            $table->string('ruta_imagen');
            $table->string('nombre_original')->nullable();
            $table->integer('orden')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inmueble_imagens');
    }
};
