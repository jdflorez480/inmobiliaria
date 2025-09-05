# 🏠 Sistema de Gestión Inmobiliaria

Sistema completo de gestión inmobiliaria desarrollado con Laravel 10 y PostgreSQL, diseñado para administrar propiedades en venta y arriendo con sistema completo de imágenes y filtros avanzados.

## 🚀 Características Principales

- ✅ **API REST completa** con Laravel 10
- ✅ **Base de datos PostgreSQL** con migraciones y seeders
- ✅ **Sistema de imágenes** con almacenamiento y gestión
- ✅ **Filtros avanzados** por ciudad, precio, habitaciones, características
- ✅ **Validaciones robustas** en backend
- ✅ **Documentación completa** de endpoints
- ✅ **Arquitectura escalable** con Eloquent ORM

## 🛠️ Tecnologías Utilizadas

### Backend:
- **PHP 8.1+**
- **Laravel 10**
- **PostgreSQL 13+**
- **Eloquent ORM**


## 📋 Prerrequisitos

Antes de instalar, asegúrate de tener:

- ✅ **PHP 8.1** o superior
- ✅ **Composer** (gestor de dependencias PHP)
- ✅ **PostgreSQL 13** o superior
- ✅ **Node.js 18** o superior
- ✅ **Git**

### Verificar instalaciones:
```bash
php --version
composer --version
psql --version
node --version
npm --version
```

## 🚀 Instalación y Configuración

### 1. **Clonar el repositorio**
```bash
git clone <URL_DEL_REPOSITORIO>
cd inmobiliaria
```

### 2. **Instalar dependencias de PHP**
```bash
composer install
```

### 3. **Instalar dependencias de Node.js**
```bash
npm install
```

### 4. **Configurar variables de entorno**
```bash
# Copiar archivo de configuración
cp .env.example .env

# Generar clave de aplicación
php artisan key:generate
```

### 5. **Configurar base de datos**

Edita el archivo `.env` con tus datos de PostgreSQL:

```env
# Configuración de base de datos
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=inmobiliaria_db
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password


# Configuración de almacenamiento
FILESYSTEM_DISK=public
```

### 6. **Crear base de datos en PostgreSQL**
```sql
-- Conectar a PostgreSQL como superusuario
psql -U postgres

-- Crear base de datos
CREATE DATABASE inmobiliaria_db;

-- Crear usuario (opcional)
CREATE USER inmobiliaria_user WITH PASSWORD 'tu_password';
GRANT ALL PRIVILEGES ON DATABASE inmobiliaria_db TO inmobiliaria_user;

-- Salir
\q
```

### 7. **Ejecutar migraciones**
```bash
# Ejecutar migraciones
php artisan migrate

# Ejecutar seeders (datos de prueba)
php artisan db:seed
```

### 8. **Crear enlace simbólico para almacenamiento**
```bash
php artisan storage:link
```

### 9. **Iniciar servidor de desarrollo**
```bash
# Backend Laravel
php artisan serve

# Frontend (en otra terminal)
npm run dev
```

## 🗄️ Estructura de Base de Datos

### **Tabla: inmuebles**
```sql
- id (bigint, PK)
- titulo (varchar 255) - Título del inmueble
- ciudad (varchar 255) - Ciudad donde se ubica
- habitaciones (integer) - Número de habitaciones
- banos (integer) - Número de baños
- tipo_consignacion (enum: 'arriendo', 'venta')
- valor_arriendo (decimal) - Precio de arriendo
- valor_venta (decimal) - Precio de venta
- descripcion (text) - Descripción detallada
- direccion (varchar 255) - Dirección completa
- metros_cuadrados (decimal) - Área en m²
- piscina (boolean) - Tiene piscina
- ascensor (boolean) - Tiene ascensor
- parqueadero (boolean) - Tiene parqueadero privado
- parqueadero_comunal (boolean) - Tiene parqueadero comunal
- created_at, updated_at (timestamps)
```

### **Tabla: inmueble_imagens**
```sql
- id (bigint, PK)
- inmueble_id (bigint, FK) - Referencia al inmueble
- ruta_imagen (varchar 255) - Ruta del archivo
- nombre_original (varchar 255) - Nombre original del archivo
- orden (integer) - Orden de visualización
- created_at, updated_at (timestamps)
```

## 🔌 Endpoints de la API

### **Base URL:** `http://localhost:8000/api`

| Método | Endpoint | Descripción |
|--------|----------|-------------|
| `GET` | `/` | Estado de la API |
| `GET` | `/inmuebles` | Listar inmuebles con filtros |
| `POST` | `/inmuebles` | Crear nuevo inmueble |
| `GET` | `/inmuebles/{id}` | Ver detalle de inmueble |
| `PUT` | `/inmuebles/{id}` | Actualizar inmueble |
| `DELETE` | `/inmuebles/{id}` | Eliminar inmueble |
| `DELETE` | `/inmuebles/{id}/imagenes/{imagenId}` | Eliminar imagen específica |
| `GET` | `/ciudades` | Listar ciudades disponibles |
| `GET` | `/estadisticas` | Obtener estadísticas generales |

### **Filtros disponibles para `/inmuebles`:**
- `?ciudad=Bogotá` - Filtrar por ciudad
- `?titulo=apartamento` - Buscar por título
- `?tipo_consignacion=venta` - Filtrar por tipo
- `?habitaciones=3` - Filtrar por habitaciones
- `?banos=2` - Filtrar por baños
- `?precio_min=100000000&precio_max=500000000` - Rango de precio
- `?piscina=true&parqueadero=true` - Filtrar por características

### **Ejemplo de respuesta exitosa:**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "titulo": "Apartamento Moderno",
        "ciudad": "Bogotá",
        "habitaciones": 3,
        "banos": 2,
        "tipo_consignacion": "venta",
        "valor_venta": "450000000.00",
        "imagenes": [
            {
                "id": 1,
                "ruta_imagen": "inmuebles/imagen1.jpg",
                "orden": 0
            }
        ]
    },
    "message": "Inmueble obtenido correctamente"
}
```

# Recrear base de datos con datos frescos
php artisan migrate:fresh --seed
```

### **Limpiar cachés**
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```



## 👥 Autor

**Juan David Florez** - Proyecto Full Stack Inmobiliaria

---

