<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\InmuebleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Ruta de validación en la raíz de la API
Route::get('/', function () {
    return response()->json([
        'success' => true,
        'message' => 'API de Inmobiliaria funcionando correctamente',
        'version' => '1.0.0',
        'timestamp' => now(),
        'endpoints' => [
            'GET /api/inmuebles' => 'Listar inmuebles con filtros',
            'POST /api/inmuebles' => 'Crear nuevo inmueble',
            'GET /api/inmuebles/{id}' => 'Ver detalle de inmueble',
            'PUT /api/inmuebles/{id}' => 'Actualizar inmueble',
            'DELETE /api/inmuebles/{id}' => 'Eliminar inmueble',
            'GET /api/ciudades' => 'Obtener lista de ciudades'
        ]
    ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas para inmuebles
Route::apiResource('inmuebles', InmuebleController::class);

// Ruta adicional para eliminar imagen específica
Route::delete('inmuebles/{inmueble}/imagenes/{imagen}', [InmuebleController::class, 'eliminarImagen']);

// Rutas adicionales para el frontend
Route::get('ciudades', function () {
    $ciudades = \App\Models\Inmueble::distinct()->pluck('ciudad');
    return response()->json([
        'success' => true,
        'data' => $ciudades,
        'message' => 'Ciudades disponibles'
    ]);
});
