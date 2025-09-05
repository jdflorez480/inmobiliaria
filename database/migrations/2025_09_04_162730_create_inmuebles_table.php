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
        Schema::create('inmuebles', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('ciudad');
            $table->integer('habitaciones');
            $table->integer('banos');
            $table->enum('tipo_consignacion', ['arriendo', 'venta']);
            $table->decimal('valor_arriendo', 15, 2)->nullable();
            $table->decimal('valor_venta', 15, 2)->nullable();
            $table->text('descripcion')->nullable();
            $table->string('direccion');
            $table->decimal('metros_cuadrados', 8, 2)->nullable();

            // Características opcionales
            $table->boolean('piscina')->default(false);
            $table->boolean('ascensor')->default(false);
            $table->boolean('parqueadero')->default(false);
            $table->boolean('parqueadero_comunal')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inmuebles');
    }
};
