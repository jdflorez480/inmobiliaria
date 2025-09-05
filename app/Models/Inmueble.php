<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inmueble extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'ciudad',
        'habitaciones',
        'banos',
        'tipo_consignacion',
        'valor_arriendo',
        'valor_venta',
        'descripcion',
        'direccion',
        'metros_cuadrados',
        'piscina',
        'ascensor',
        'parqueadero',
        'parqueadero_comunal'
    ];

    protected $casts = [
        'valor_arriendo' => 'decimal:2',
        'valor_venta' => 'decimal:2',
        'metros_cuadrados' => 'decimal:2',
        'piscina' => 'boolean',
        'ascensor' => 'boolean',
        'parqueadero' => 'boolean',
        'parqueadero_comunal' => 'boolean',
    ];

    public function imagenes()
    {
        return $this->hasMany(InmuebleImagen::class);
    }

    // Scope para filtrar por ciudad
    public function scopePorCiudad($query, $ciudad)
    {
        return $query->where('ciudad', 'like', "%{$ciudad}%");
    }

    // Scope para búsqueda por título
    public function scopePorTitulo($query, $titulo)
    {
        return $query->where('titulo', 'like', "%{$titulo}%");
    }

    // Scope para filtrar por rango de precio
    public function scopePorRangoPrecio($query, $min = null, $max = null, $tipo = 'venta')
    {
        $campo = $tipo === 'arriendo' ? 'valor_arriendo' : 'valor_venta';

        if ($min && $max) {
            return $query->whereBetween($campo, [$min, $max]);
        } elseif ($min) {
            return $query->where($campo, '>=', $min);
        } elseif ($max) {
            return $query->where($campo, '<=', $max);
        }

        return $query;
    }

    // Scope para filtrar por número de habitaciones
    public function scopePorHabitaciones($query, $habitaciones)
    {
        if (is_array($habitaciones)) {
            return $query->whereIn('habitaciones', $habitaciones);
        }
        return $query->where('habitaciones', $habitaciones);
    }

    // Scope para filtrar por número de baños
    public function scopePorBanos($query, $banos)
    {
        if (is_array($banos)) {
            return $query->whereIn('banos', $banos);
        }
        return $query->where('banos', $banos);
    }

    // Scope para filtrar por características opcionales
    public function scopeConCaracteristicas($query, $caracteristicas = [])
    {
        foreach ($caracteristicas as $caracteristica => $valor) {
            if ($valor) {
                $query->where($caracteristica, true);
            }
        }
        return $query;
    }
}
