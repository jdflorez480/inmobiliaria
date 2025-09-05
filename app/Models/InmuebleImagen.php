<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InmuebleImagen extends Model
{
    use HasFactory;

    protected $fillable = [
        'inmueble_id',
        'ruta_imagen',
        'nombre_original',
        'orden'
    ];

    public function inmueble()
    {
        return $this->belongsTo(Inmueble::class);
    }

    // Accessor para obtener la URL completa de la imagen
    public function getUrlImagenAttribute()
    {
        return asset('storage/' . $this->ruta_imagen);
    }
}
