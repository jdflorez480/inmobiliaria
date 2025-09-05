<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inmueble;
use App\Models\InmuebleImagen;

class InmuebleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inmuebles = [
            // Bucaramanga - Ciudad principal (más repetida)
            [
                'titulo' => 'Apartamento Ejecutivo en Cabecera',
                'ciudad' => 'Bucaramanga',
                'habitaciones' => 3,
                'banos' => 2,
                'tipo_consignacion' => 'venta',
                'valor_venta' => 280000000,
                'descripcion' => 'Hermoso apartamento en el sector de Cabecera del Llano con excelente ubicación',
                'direccion' => 'Carrera 35 #54-120, Cabecera',
                'metros_cuadrados' => 85.0,
                'piscina' => true,
                'ascensor' => true,
                'parqueadero' => true,
                'parqueadero_comunal' => false,
            ],
            [
                'titulo' => 'Casa Moderna en Lagos del Cacique',
                'ciudad' => 'Bucaramanga',
                'habitaciones' => 4,
                'banos' => 3,
                'tipo_consignacion' => 'venta',
                'valor_venta' => 450000000,
                'descripcion' => 'Casa de dos pisos en exclusivo conjunto cerrado Lagos del Cacique',
                'direccion' => 'Calle 45 #27-15, Lagos del Cacique',
                'metros_cuadrados' => 150.0,
                'piscina' => true,
                'ascensor' => false,
                'parqueadero' => true,
                'parqueadero_comunal' => true,
            ],
            [
                'titulo' => 'Apartamento en Arriendo Centro',
                'ciudad' => 'Bucaramanga',
                'habitaciones' => 2,
                'banos' => 1,
                'tipo_consignacion' => 'arriendo',
                'valor_arriendo' => 800000,
                'descripcion' => 'Cómodo apartamento en el centro de Bucaramanga, cerca al comercio',
                'direccion' => 'Carrera 21 #34-67, Centro',
                'metros_cuadrados' => 65.0,
                'piscina' => false,
                'ascensor' => true,
                'parqueadero' => false,
                'parqueadero_comunal' => true,
            ],
            [
                'titulo' => 'Estudio Amoblado en Sotomayor',
                'ciudad' => 'Bucaramanga',
                'habitaciones' => 1,
                'banos' => 1,
                'tipo_consignacion' => 'arriendo',
                'valor_arriendo' => 600000,
                'descripcion' => 'Estudio completamente amoblado ideal para estudiantes o profesionales',
                'direccion' => 'Calle 56 #30-45, Sotomayor',
                'metros_cuadrados' => 40.0,
                'piscina' => false,
                'ascensor' => true,
                'parqueadero' => false,
                'parqueadero_comunal' => false,
            ],
            [
                'titulo' => 'Casa Familiar en Altos de Cabecera',
                'ciudad' => 'Bucaramanga',
                'habitaciones' => 3,
                'banos' => 2,
                'tipo_consignacion' => 'venta',
                'valor_venta' => 320000000,
                'descripcion' => 'Casa unifamiliar en sector residencial tranquilo y seguro',
                'direccion' => 'Calle 42 #35-89, Altos de Cabecera',
                'metros_cuadrados' => 120.0,
                'piscina' => false,
                'ascensor' => false,
                'parqueadero' => true,
                'parqueadero_comunal' => false,
            ],
            [
                'titulo' => 'Apartamento de Lujo en Mutis',
                'ciudad' => 'Bucaramanga',
                'habitaciones' => 2,
                'banos' => 2,
                'tipo_consignacion' => 'arriendo',
                'valor_arriendo' => 1200000,
                'descripcion' => 'Lujoso apartamento con acabados premium y vista panorámica',
                'direccion' => 'Carrera 27 #52-180, Mutis',
                'metros_cuadrados' => 75.0,
                'piscina' => true,
                'ascensor' => true,
                'parqueadero' => true,
                'parqueadero_comunal' => true,
            ],

            // Bogotá - Segunda ciudad
            [
                'titulo' => 'Apartamento Zona Rosa',
                'ciudad' => 'Bogotá',
                'habitaciones' => 3,
                'banos' => 2,
                'tipo_consignacion' => 'venta',
                'valor_venta' => 450000000,
                'descripcion' => 'Elegante apartamento en la exclusiva Zona Rosa de Bogotá',
                'direccion' => 'Carrera 13 #85-67, Zona Rosa',
                'metros_cuadrados' => 95.0,
                'piscina' => true,
                'ascensor' => true,
                'parqueadero' => true,
                'parqueadero_comunal' => false,
            ],
            [
                'titulo' => 'Estudio en Chapinero',
                'ciudad' => 'Bogotá',
                'habitaciones' => 1,
                'banos' => 1,
                'tipo_consignacion' => 'arriendo',
                'valor_arriendo' => 900000,
                'descripcion' => 'Moderno estudio en el corazón de Chapinero',
                'direccion' => 'Carrera 11 #63-45, Chapinero',
                'metros_cuadrados' => 35.0,
                'piscina' => false,
                'ascensor' => true,
                'parqueadero' => false,
                'parqueadero_comunal' => true,
            ],

            // Medellín - Tercera ciudad
            [
                'titulo' => 'Apartamento El Poblado',
                'ciudad' => 'Medellín',
                'habitaciones' => 2,
                'banos' => 2,
                'tipo_consignacion' => 'arriendo',
                'valor_arriendo' => 1500000,
                'descripcion' => 'Moderno apartamento en el exclusivo sector de El Poblado',
                'direccion' => 'Carrera 43A #5-15, El Poblado',
                'metros_cuadrados' => 70.0,
                'piscina' => true,
                'ascensor' => true,
                'parqueadero' => true,
                'parqueadero_comunal' => true,
            ],
            [
                'titulo' => 'Casa en Laureles',
                'ciudad' => 'Medellín',
                'habitaciones' => 4,
                'banos' => 3,
                'tipo_consignacion' => 'venta',
                'valor_venta' => 380000000,
                'descripcion' => 'Hermosa casa en el tradicional barrio Laureles',
                'direccion' => 'Carrera 75 #42-18, Laureles',
                'metros_cuadrados' => 130.0,
                'piscina' => false,
                'ascensor' => false,
                'parqueadero' => true,
                'parqueadero_comunal' => false,
            ]
        ];

        foreach ($inmuebles as $inmuebleData) {
            Inmueble::create($inmuebleData);
        }
    }
}
