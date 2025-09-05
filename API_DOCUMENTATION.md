# API de Inmobiliaria - Documentación

## Información General

- **URL Base:** `http://127.0.0.1:8000/api`
- **Formato de respuesta:** JSON
- **Autenticación:** No requerida para endpoints públicos

## Endpoints Disponibles

### 1. Validación de API
```
GET /api/
```
**Descripción:** Valida que la API esté funcionando correctamente y muestra información general.

**Respuesta exitosa:**
```json
{
    "success": true,
    "message": "API de Inmobiliaria funcionando correctamente",
    "version": "1.0.0",
    "timestamp": "2025-09-04T16:40:00.000000Z",
    "endpoints": {
        "GET /api/inmuebles": "Listar inmuebles con filtros",
        "POST /api/inmuebles": "Crear nuevo inmueble",
        "GET /api/inmuebles/{id}": "Ver detalle de inmueble",
        "PUT /api/inmuebles/{id}": "Actualizar inmueble",
        "DELETE /api/inmuebles/{id}": "Eliminar inmueble",
        "GET /api/ciudades": "Obtener lista de ciudades",
        "GET /api/estadisticas": "Obtener estadísticas generales"
    }
}
```

### 2. Listar Inmuebles
```
GET /api/inmuebles
```
**Descripción:** Obtiene una lista completa de inmuebles con filtros opcionales (sin paginación).

**Parámetros de consulta:**
- `ciudad` (string): Filtrar por ciudad (búsqueda con LIKE)
- `precio_min` (number): Precio mínimo
- `precio_max` (number): Precio máximo
- `tipo_consignacion` (string): "arriendo" o "venta" (para filtros de precio)
- `habitaciones` (array|string): Número de habitaciones (múltiple: "1,2,3")
- `piscina` (boolean): Con piscina
- `ascensor` (boolean): Con ascensor
- `parqueadero` (boolean): Con parqueadero
- `parqueadero_comunal` (boolean): Con parqueadero comunal

**Respuesta exitosa:**
```json
{
    "success": true,
    "data": [...array de inmuebles...],
    "total": 8,
    "message": "Inmuebles obtenidos correctamente"
}
```

**Ejemplos:**
```
GET /api/inmuebles?ciudad=Bogotá
GET /api/inmuebles?habitaciones=1,2,3
GET /api/inmuebles?precio_min=200000000&precio_max=500000000&tipo_consignacion=venta
GET /api/inmuebles?piscina=true&ascensor=true
```

### 3. Ver Detalle de Inmueble
```
GET /api/inmuebles/{id}
```
**Descripción:** Obtiene el detalle completo de un inmueble específico.

### 4. Crear Inmueble
```
POST /api/inmuebles
```
**Descripción:** Crea un nuevo inmueble.

**Content-Type:** 
- `application/json` (sin imágenes)
- `multipart/form-data` (con imágenes)

**Campos requeridos:**
- `ciudad` (string, max:255): Ciudad donde está ubicado
- `habitaciones` (integer, min:1): Número de habitaciones
- `banos` (integer, min:1): Número de baños
- `tipo_consignacion` (string): "arriendo" o "venta"
- `direccion` (string, max:255): Dirección del inmueble

**Campos condicionales:**
- `valor_arriendo` (numeric, min:0): Requerido si tipo_consignacion es "arriendo"
- `valor_venta` (numeric, min:0): Requerido si tipo_consignacion es "venta"

**Campos opcionales:**
- `descripcion` (string): Descripción del inmueble
- `metros_cuadrados` (numeric, min:0): Metros cuadrados
- `piscina` (boolean): Default false
- `ascensor` (boolean): Default false
- `parqueadero` (boolean): Default false
- `parqueadero_comunal` (boolean): Default false
- `imagenes[]` (files): Imágenes del inmueble (jpeg,png,jpg,gif, max:2MB c/u)

**Ejemplo JSON (venta):**
```json
{
  "ciudad": "Bogotá",
  "habitaciones": 3,
  "banos": 2,
  "tipo_consignacion": "venta",
  "valor_venta": 350000000,
  "descripcion": "Apartamento luminoso en zona norte",
  "direccion": "Calle 100 #15-30",
  "metros_cuadrados": 85.5,
  "piscina": true,
  "ascensor": true,
  "parqueadero": true,
  "parqueadero_comunal": false
}
```

**Ejemplo JSON (arriendo):**
```json
{
  "ciudad": "Medellín",
  "habitaciones": 2,
  "banos": 1,
  "tipo_consignacion": "arriendo",
  "valor_arriendo": 1200000,
  "descripcion": "Apartamento cerca al parque",
  "direccion": "Carrera 43A #5-15",
  "metros_cuadrados": 65.0,
  "piscina": false,
  "ascensor": true,
  "parqueadero": true,
  "parqueadero_comunal": true
}
```

### 5. Actualizar Inmueble
```
PUT /api/inmuebles/{id}
```
**Descripción:** Actualiza un inmueble existente.

**Content-Type:** 
- `application/json` (sin imágenes)
- `multipart/form-data` (con imágenes)

**Validaciones:** Mismas reglas que crear, pero con `sometimes|required` para campos obligatorios (solo se validan si están presentes).

**Nota:** Las nuevas imágenes se añaden a las existentes. Para eliminar imágenes específicas usar el endpoint dedicado.

### 6. Eliminar Inmueble
```
DELETE /api/inmuebles/{id}
```
**Descripción:** Elimina un inmueble y sus imágenes asociadas.

### 7. Eliminar Imagen Específica
```
DELETE /api/inmuebles/{inmueble}/imagenes/{imagen}
```
**Descripción:** Elimina una imagen específica de un inmueble.

### 8. Obtener Ciudades
```
GET /api/ciudades
```
**Descripción:** Obtiene la lista de ciudades disponibles.

**Respuesta:**
```json
{
    "success": true,
    "data": ["Barranquilla", "Bogotá", "Medellín", "Cartagena", "Cali"],
    "message": "Ciudades disponibles"
}
```

### 9. Obtener Estadísticas
```
GET /api/estadisticas
```
**Descripción:** Obtiene estadísticas generales de la base de datos.

**Respuesta:**
```json
{
    "success": true,
    "data": {
        "total": 8,
        "en_venta": 4,
        "en_arriendo": 4
    },
    "message": "Estadísticas obtenidas correctamente"
}
```

## Estructura de Respuesta Estándar

Todas las respuestas siguen el siguiente formato:

```json
{
    "success": boolean,
    "data": object|array,
    "message": string,
    "errors": object (solo en errores de validación)
}
```

## Códigos de Estado HTTP

- `200`: Operación exitosa
- `201`: Recurso creado exitosamente
- `404`: Recurso no encontrado
- `422`: Error de validación
- `500`: Error interno del servidor

## Estructura del Modelo Inmueble

```json
{
    "id": 1,
    "ciudad": "Bogotá",
    "habitaciones": 3,
    "banos": 2,
    "tipo_consignacion": "venta",
    "valor_arriendo": null,
    "valor_venta": "350000000.00",
    "descripcion": "Hermoso apartamento en el norte de Bogotá",
    "direccion": "Calle 100 #15-30",
    "metros_cuadrados": "85.50",
    "piscina": true,
    "ascensor": true,
    "parqueadero": true,
    "parqueadero_comunal": false,
    "created_at": "2025-09-04T16:30:00.000000Z",
    "updated_at": "2025-09-04T16:30:00.000000Z",
    "imagenes": [
        {
            "id": 1,
            "inmueble_id": 1,
            "ruta_imagen": "inmuebles/imagen1.jpg",
            "nombre_original": "casa1.jpg",
            "orden": 0,
            "url_imagen": "http://127.0.0.1:8000/storage/inmuebles/imagen1.jpg"
        }
    ]
}
```

## Pruebas de la API

Para probar la API puedes usar herramientas como:
- Postman
- Insomnia
- Thunder Client (VS Code Extension)
- curl (en sistemas Unix)
- PowerShell (en Windows)

### Ejemplos con PowerShell:
```powershell
# Validar API
Invoke-WebRequest -Uri "http://127.0.0.1:8000/api/" -Method GET

# Listar todos los inmuebles
Invoke-WebRequest -Uri "http://127.0.0.1:8000/api/inmuebles" -Method GET

# Filtrar por ciudad
Invoke-WebRequest -Uri "http://127.0.0.1:8000/api/inmuebles?ciudad=Bogotá" -Method GET

# Filtros combinados
Invoke-WebRequest -Uri "http://127.0.0.1:8000/api/inmuebles?ciudad=Medellín&habitaciones=2,3&piscina=true" -Method GET

# Obtener ciudades disponibles
Invoke-WebRequest -Uri "http://127.0.0.1:8000/api/ciudades" -Method GET

# Obtener estadísticas
Invoke-WebRequest -Uri "http://127.0.0.1:8000/api/estadisticas" -Method GET
```

### Crear inmueble con PowerShell:
```powershell
$body = @{
    ciudad = "Bogotá"
    habitaciones = 3
    banos = 2
    tipo_consignacion = "venta"
    valor_venta = 350000000
    descripcion = "Apartamento de prueba"
    direccion = "Calle 100 #15-30"
    piscina = $true
} | ConvertTo-Json

Invoke-WebRequest -Uri "http://127.0.0.1:8000/api/inmuebles" -Method POST -Body $body -ContentType "application/json"
```
