<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inmueble;
use App\Models\InmuebleImagen;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class InmuebleController extends Controller
{
    /**
     * Display a listing of the resource with filtering. Listamos los inmuebles
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = Inmueble::with(['imagenes' => function($q) {
            $q->orderBy('orden');
        }]);

        // Filtro por ciudad
        if ($request->filled('ciudad')) {
            $query->porCiudad($request->ciudad);
        }

        // Filtro por título
        if ($request->filled('titulo')) {
            $query->porTitulo($request->titulo);
        }

        // Filtro por tipo de consignación
        if ($request->filled('tipo_consignacion')) {
            $query->where('tipo_consignacion', $request->tipo_consignacion);
        }

        // Filtro por rango de precio
        if ($request->filled('precio_min') || $request->filled('precio_max')) {
            $tipoConsignacion = $request->get('tipo_consignacion', 'venta');
            $query->porRangoPrecio(
                $request->precio_min,
                $request->precio_max,
                $tipoConsignacion
            );
        }

        // Filtro por número de habitaciones (múltiple)
        if ($request->filled('habitaciones')) {
            $habitaciones = is_array($request->habitaciones)
                ? $request->habitaciones
                : explode(',', $request->habitaciones);
            $query->porHabitaciones($habitaciones);
        }

        // Filtro por número de baños (múltiple)
        if ($request->filled('banos')) {
            $banos = is_array($request->banos)
                ? $request->banos
                : explode(',', $request->banos);
            $query->porBanos($banos);
        }

        // Filtros por características opcionales
        $caracteristicas = [];
        if ($request->boolean('piscina')) $caracteristicas['piscina'] = true;
        if ($request->boolean('ascensor')) $caracteristicas['ascensor'] = true;
        if ($request->boolean('parqueadero')) $caracteristicas['parqueadero'] = true;
        if ($request->boolean('parqueadero_comunal')) $caracteristicas['parqueadero_comunal'] = true;

        if (!empty($caracteristicas)) {
            $query->conCaracteristicas($caracteristicas);
        }

        // Ordenamiento simple
        $query->orderBy('created_at', 'desc');

        // Obtener todos los resultados
        $inmuebles = $query->get();

        return response()->json([
            'success' => true,
            'data' => $inmuebles,
            'total' => $inmuebles->count(),
            'message' => 'Inmuebles obtenidos correctamente'
        ], 200);
    }

    /**
     * Store a newly created resource in storage. Creamos el inmueble
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'habitaciones' => 'required|integer|min:1',
            'banos' => 'required|integer|min:1',
            'tipo_consignacion' => 'required|in:arriendo,venta',
            'valor_arriendo' => 'nullable|numeric|min:0',
            'valor_venta' => 'nullable|numeric|min:0',
            'descripcion' => 'nullable|string',
            'direccion' => 'required|string|max:255',
            'metros_cuadrados' => 'nullable|numeric|min:0',
            'piscina' => 'boolean',
            'ascensor' => 'boolean',
            'parqueadero' => 'boolean',
            'parqueadero_comunal' => 'boolean',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Error de validación'
            ], 422);
        }

        // Validar que tenga al menos un valor según el tipo de consignación
        if ($request->tipo_consignacion === 'arriendo' && !$request->valor_arriendo) {
            return response()->json([
                'success' => false,
                'message' => 'El valor de arriendo es requerido'
            ], 422);
        }

        if ($request->tipo_consignacion === 'venta' && !$request->valor_venta) {
            return response()->json([
                'success' => false,
                'message' => 'El valor de venta es requerido'
            ], 422);
        }

        $inmueble = Inmueble::create($request->all());

        // Manejar imágenes
        if ($request->hasFile('imagenes')) {
            $this->procesarImagenes($inmueble, $request->file('imagenes'));
        }

        $inmueble->load('imagenes');

        return response()->json([
            'success' => true,
            'data' => $inmueble,
            'message' => 'Inmueble creado correctamente'
        ], 201);
    }

    /**
     * Display the specified resource. Mostramos un inmueble
     */
    public function show(string $id): JsonResponse
    {
        $inmueble = Inmueble::with('imagenes')->find($id);

        if (!$inmueble) {
            return response()->json([
                'success' => false,
                'message' => 'Inmueble no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $inmueble,
            'message' => 'Inmueble obtenido correctamente'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $inmueble = Inmueble::find($id);

        if (!$inmueble) {
            return response()->json([
                'success' => false,
                'message' => 'Inmueble no encontrado'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'titulo' => 'sometimes|required|string|max:255',
            'ciudad' => 'sometimes|required|string|max:255',
            'habitaciones' => 'sometimes|required|integer|min:1',
            'banos' => 'sometimes|required|integer|min:1',
            'tipo_consignacion' => 'sometimes|required|in:arriendo,venta',
            'valor_arriendo' => 'nullable|numeric|min:0',
            'valor_venta' => 'nullable|numeric|min:0',
            'descripcion' => 'nullable|string',
            'direccion' => 'sometimes|required|string|max:255',
            'metros_cuadrados' => 'nullable|numeric|min:0',
            'piscina' => 'boolean',
            'ascensor' => 'boolean',
            'parqueadero' => 'boolean',
            'parqueadero_comunal' => 'boolean',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Error de validación'
            ], 422);
        }

        $inmueble->update($request->all());

        // Manejar nuevas imágenes
        if ($request->hasFile('imagenes')) {
            $this->procesarImagenes($inmueble, $request->file('imagenes'));
        }

        $inmueble->load('imagenes');

        return response()->json([
            'success' => true,
            'data' => $inmueble,
            'message' => 'Inmueble actualizado correctamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $inmueble = Inmueble::find($id);

        if (!$inmueble) {
            return response()->json([
                'success' => false,
                'message' => 'Inmueble no encontrado'
            ], 404);
        }

        // Eliminar imágenes del storage
        foreach ($inmueble->imagenes as $imagen) {
            Storage::disk('public')->delete($imagen->ruta_imagen);
        }

        $inmueble->delete();

        return response()->json([
            'success' => true,
            'message' => 'Inmueble eliminado correctamente'
        ]);
    }

    /**
     * Procesar y guardar imágenes
     */
    private function procesarImagenes(Inmueble $inmueble, array $imagenes): void
    {
        foreach ($imagenes as $index => $imagen) {
            $nombreArchivo = time() . '_' . $index . '.' . $imagen->getClientOriginalExtension();
            $rutaImagen = $imagen->storeAs('inmuebles', $nombreArchivo, 'public');

            InmuebleImagen::create([
                'inmueble_id' => $inmueble->id,
                'ruta_imagen' => $rutaImagen,
                'nombre_original' => $imagen->getClientOriginalName(),
                'orden' => $index
            ]);
        }
    }

    /**
     * Eliminar una imagen específica
     */
    public function eliminarImagen(string $inmuebleId, string $imagenId): JsonResponse
    {
        $imagen = InmuebleImagen::where('inmueble_id', $inmuebleId)
                                ->where('id', $imagenId)
                                ->first();

        if (!$imagen) {
            return response()->json([
                'success' => false,
                'message' => 'Imagen no encontrada'
            ], 404);
        }

        Storage::disk('public')->delete($imagen->ruta_imagen);
        $imagen->delete();

        return response()->json([
            'success' => true,
            'message' => 'Imagen eliminada correctamente'
        ]);
    }
}
