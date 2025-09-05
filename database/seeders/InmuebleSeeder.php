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
            [
                'titulo' => 'Apartamento de Lujo en Zona Norte',
                'ciudad' => 'Bogotá',
                'habitaciones' => 3,
                'banos' => 2,
                'tipo_consignacion' => 'venta',
                'valor_venta' => 350000000,
                'descripcion' => 'Hermoso apartamento en el norte de Bogotá',
                'direccion' => 'Calle 100 #15-30',
                'metros_cuadrados' => 85.5,
                'piscina' => true,
                'ascensor' => true,
                'parqueadero' => true,
                'parqueadero_comunal' => false,
            ],
            [
                'titulo' => 'Moderno Apartamento en El Poblado',
                'ciudad' => 'Medellín',
                'habitaciones' => 2,
                'banos' => 1,
                'tipo_consignacion' => 'arriendo',
                'valor_arriendo' => 1200000,
                'descripcion' => 'Apartamento cómodo en El Poblado',
                'direccion' => 'Carrera 43A #5-15',
                'metros_cuadrados' => 65.0,
                'piscina' => false,
                'ascensor' => true,
                'parqueadero' => true,
                'parqueadero_comunal' => true,
            ],
            [
                'titulo' => 'Casa Familiar con Piscina',
                'ciudad' => 'Cali',
                'habitaciones' => 4,
                'banos' => 3,
                'tipo_consignacion' => 'venta',
                'valor_venta' => 280000000,
                'descripcion' => 'Casa espaciosa en zona residencial',
                'direccion' => 'Avenida 6N #25-40',
                'metros_cuadrados' => 120.0,
                'piscina' => true,
                'ascensor' => false,
                'parqueadero' => true,
                'parqueadero_comunal' => false,
            ],
            [
                'ciudad' => 'Bogotá',
                'habitaciones' => 1,
                'banos' => 1,
                'tipo_consignacion' => 'arriendo',
                'valor_arriendo' => 800000,
                'descripcion' => 'Estudio moderno en Chapinero',
                'direccion' => 'Carrera 13 #63-45',
                'metros_cuadrados' => 35.0,
                'piscina' => false,
                'ascensor' => true,
                'parqueadero' => false,
                'parqueadero_comunal' => true,
            ],
            [
                'ciudad' => 'Cartagena',
                'habitaciones' => 3,
                'banos' => 2,
                'tipo_consignacion' => 'venta',
                'valor_venta' => 450000000,
                'descripcion' => 'Apartamento frente al mar',
                'direccion' => 'Avenida San Martín #7-15',
                'metros_cuadrados' => 95.0,
                'piscina' => true,
                'ascensor' => true,
                'parqueadero' => true,
                'parqueadero_comunal' => true,
            ],
            [
                'ciudad' => 'Medellín',
                'habitaciones' => 2,
                'banos' => 2,
                'tipo_consignacion' => 'venta',
                'valor_venta' => 220000000,
                'descripcion' => 'Apartamento en Laureles',
                'direccion' => 'Carrera 75 #42-18',
                'metros_cuadrados' => 70.0,
                'piscina' => false,
                'ascensor' => true,
                'parqueadero' => true,
                'parqueadero_comunal' => false,
            ],
            [
                'ciudad' => 'Barranquilla',
                'habitaciones' => 3,
                'banos' => 2,
                'tipo_consignacion' => 'arriendo',
                'valor_arriendo' => 1500000,
                'descripcion' => 'Casa en el norte de Barranquilla',
                'direccion' => 'Calle 85 #52-30',
                'metros_cuadrados' => 110.0,
                'piscina' => true,
                'ascensor' => false,
                'parqueadero' => true,
                'parqueadero_comunal' => false,
            ],
            [
                'ciudad' => 'Cali',
                'habitaciones' => 2,
                'banos' => 1,
                'tipo_consignacion' => 'arriendo',
                'valor_arriendo' => 900000,
                'descripcion' => 'Apartamento en Granada',
                'direccion' => 'Carrera 1 #70-25',
                'metros_cuadrados' => 55.0,
                'piscina' => false,
                'ascensor' => false,
                'parqueadero' => true,
                'parqueadero_comunal' => true,
            ]
        ];

        foreach ($inmuebles as $inmuebleData) {
            Inmueble::create($inmuebleData);
        }
    }
}
