# 🎫 TicketPro API

API REST desarrollada con Laravel 8 y Sanctum, que permite gestionar tickets, categorías y comentarios jerárquicos en un sistema autenticado.

---

## 🧩 Contenido

1. [Descripción](#-descripción)  
2. [Tecnologías](#-tecnologías)  
3. [Instalación y ejecución](#-instalación-y-ejecución)  
4. [Endpoints principales](#-endpoints-principales)  
5. [Filtros y paginación](#-filtros-y-paginación)  
6. [Respuestas JSON unificadas](#-respuestas-json-unificadas)  
7. [Planeado para futuro](#-planeado-para-futuro)  

---

## 📝 Descripción

TicketPro API permite a usuarios autenticados:
- Gestionar el ciclo completo de tickets (crear, consultar, actualizar, eliminar).
- Clasificar tickets en categorías.
- Agregar comentarios y respuestas jerárquicas dentro de los tickets.

Diseñada con buenas prácticas, validaciones en español y respuestas consistentes.

---

## ⚙️ Tecnologías

- PHP 8.x  
- Laravel 8.x + Sanctum  
- MySQL / PostgreSQL  
- Eloquent ORM  
- (Próximamente) PHPUnit para tests

---

## 🚀 Instalación y ejecución

```bash
git clone https://github.com/jflenis36/ticketpro-api.git
cd ticketpro-api
composer install
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

---

## Endpoints principales

### 🛡️ Autenticación - 🔑 Iniciar sesión
- **Método:** POST  
- **Ruta:** `/api/auth/login`  
- **Body:**
```json
{
  "email": "admin@email.com",
  "password": "admin"
}
```

### 🛡️ Autenticación - 🧾 Registrar usuario
- **Método:** POST  
- **Ruta:** `/api/auth/register`  
- **Body:**
```json
{
  "name": "prueba",
  "email": "prueba@email.com",
  "password": "adminss"
}
```

### 🛡️ Autenticación - 🚪 Cerrar sesión
- **Método:** POST  
- **Ruta:** `/api/auth/logout`  
- **Header:** `Authorization: Bearer {token}`

### 🎫 Tickets - 📋 Listar tickets
- **Método:** GET  
- **Ruta:** `/api/ticket`  
- **Header:** `Authorization: Bearer {token}`
- **Query Params (opcionales):** 
  - `status=open`
  - `priority=high`
  - `q=palabra_clave`
  - `from=2024-06-01`
  - `to=2024-06-10`
  - `sort_by=created_at`
  - `sort_order=asc`
  - `per_page=10`

### 🎫 Tickets - 🔍 Ver detalles de un ticket
- **Método:** GET  
- **Ruta:** `/api/ticket/{id}`  
- **Header:** `Authorization: Bearer {token}`

### 🎫 Tickets - ➕ Crear ticket
- **Método:** POST  
- **Ruta:** `/api/ticket`  
- **Header:** `Authorization: Bearer {token}`
- **Body:**
```json
{
  "title": "prueba",
  "description": "descripción de prueba para este caso",
  "priority": "low",
  "category_id": 1
}
```

### 🎫 Tickets - ✏️ Actualizar ticket
- **Método:** PUT  
- **Ruta:** `/api/ticket/{id}`  
- **Header:** `Authorization: Bearer {token}`
- **Body:**
```json
{
  "title": "actualizado",
  "description": "descripción actualizada",
  "priority": "high",
  "category_id": 1
}
```

### 🎫 Tickets - ❌ Eliminar ticket
- **Método:** DELETE  
- **Ruta:** `/api/ticket/{id}`  
- **Header:** `Authorization: Bearer {token}`

### 📂 Categorías - 📋 Listar categorías
- **Método:** GET  
- **Ruta:** `/api/category`  
- **Header:** `Authorization: Bearer {token}`

### 📂 Categorías - 🔍 Ver detalles de una categoría
- **Método:** GET  
- **Ruta:** `/api/category/{id}`  
- **Header:** `Authorization: Bearer {token}`

### 📂 Categorías - ➕ Crear categoría
- **Método:** POST  
- **Ruta:** `/api/category`  
- **Header:** `Authorization: Bearer {token}`
- **Body:**
```json
{
  "name": "nombre"
}
```

### 📂 Categorías - ✏️ Actualizar categoría
- **Método:** PUT  
- **Ruta:** `/api/category/{id}`  
- **Header:** `Authorization: Bearer {token}`
- **Body:**
```json
{
  "name": "nombre"
}
```

### 📂 Categorías - ❌ Eliminar categoría
- **Método:** DELETE  
- **Ruta:** `/api/category/{id}`  
- **Header:** `Authorization: Bearer {token}`

💬 Comentarios - 🗂️ Listar comentarios de un ticket
- **Método:** GET  
- **Ruta:** `/api/ticket/{ticket_id}/comments`  
- **Header:** `Authorization: Bearer {token}`

💬 Comentarios - ➕ Crear comentario en un ticket
- **Método:** POST  
- **Ruta:** `/api/ticket/{ticket_id}/comments`  
- **Header:** `Authorization: Bearer {token}`
- **Body:**
```json
{
  "content": "texto del comentario"
}
```

💬 Comentarios - 🔍 Ver respuestas a un comentario
- **Método:** GET  
- **Ruta:** `/api/comment/{comment_id}`  
- **Header:** `Authorization: Bearer {token}`

💬 Comentarios - 🔁 Responder a un comentario
- **Método:** POST  
- **Ruta:** `/api/comment/{comment_id}/reply`  
- **Header:** `Authorization: Bearer {token}`
- **Body:**
```json
{
  "content": "respuesta"
}

💬 Comentarios - ✏️ Actualizar comentario o respuesta
- **Método:** PUT  
- **Ruta:** `/api/comment/{id}`  
- **Header:** `Authorization: Bearer {token}`
- **Body:**
```json
{
  "content": "comentario actualizado"
}
```

💬 Comentarios - ❌ Eliminar comentario o respuesta
- **Método:** DELETE  
- **Ruta:** `/api/comment/{id}`  
- **Header:** `Authorization: Bearer {token}`

---

## 🔍 Filtros y paginación

El endpoint `GET /api/ticket` permite filtrar y paginar los resultados de tickets según múltiples criterios. Todos los parámetros son opcionales y pueden combinarse.

### 📌 Parámetros disponibles

- `status=<open|in_progress|closed>`  
  Filtra por estado del ticket.

- `priority=<low|medium|high>`  
  Filtra por nivel de prioridad.

- `q=<término>`  
  Busca en los campos `title` y `description`.

- `category_id=<ID>`  
  Filtra por categoría.

- `from=YYYY-MM-DD`  
  Fecha mínima de creación del ticket.

- `to=YYYY-MM-DD`  
  Fecha máxima de creación del ticket.

- `sort_by=<campo>`  
  Campo por el que se desea ordenar (ej. `created_at`, `priority`, `status`).

- `sort_order=<asc|desc>`  
  Orden ascendente o descendente. Valor por defecto: `desc`.

- `per_page=<número>`  
  Define cuántos resultados por página se retornan. Si se omite, retorna todos.

### 🧪 Ejemplo de uso:

```http
GET /api/ticket?status=open&priority=high&q=fallo&from=2025-06-01&to=2025-06-10&sort_by=created_at&sort_order=desc&per_page=10
```

---

## 📦 Formato de Respuesta JSON Unificado

Todas las respuestas de la API siguen un formato estándar para facilitar el manejo de errores y datos en el frontend.

### ✅ Respuesta exitosa

```json
{
  "ok": true,
  "status": "success",
  "code": 200,
  "message": "Operación exitosa.",
  "data": {
    // Contenido según el endpoint
  }
}
```

### ❌ Error por validación
```json
{
  "ok": false,
  "status": "error",
  "code": 422,
  "message": "El campo email es obligatorio. El campo password es obligatorio.",
  "errors": null
}
```

### ❌ Error de ruta no encontrada
```json
{
  "ok": false,
  "status": "error",
  "code": 404,
  "message": "Ruta no encontrada.",
  "errors": null
}
```

### ❌ Error por método no permitido
```json
{
  "ok": false,
  "status": "error",
  "code": 405,
  "message": "El método GET no está permitido para esta ruta. Métodos soportados: POST.",
  "errors": null
}
```

### ⚙️ Notas
 - `ok: ` Booleano que indica éxito (`true`) o error (`false`).
 - `status: ` Texto indicando `success` o `error`.
 - `code: ` Código HTTP correspondiente.
 - `message: ` Mensaje claro para el cliente, siempre en español
 - `data: ` Presente solo en respuestas exitosas, contiene los datos solicitados.

## 🔮 Funcionalidades Pensadas a Futuro

Estas son ideas que se implementarán más adelante para enriquecer la API y la experiencia del usuario. Actualmente no forman parte del MVP.

### 🧭 Filtros avanzados
- Búsqueda combinada por estado, prioridad, categoría, palabra clave y fecha.
- Filtros globales reutilizables con scopes y DTOs.
- Endpoint optimizado para reportes.

### 📄 Exportaciones
- Exportar tickets a PDF o Excel.
- Generar reportes descargables por fechas y filtros personalizados.

### 📊 Dashboard administrativo
- Métricas de uso.
- Cantidad de tickets por estado y categoría.
- Actividad reciente y tickets por usuario.

### ✅ Tests automáticos
- Pruebas unitarias con PHPUnit.
- Tests de integración con Passport o Sanctum.
- Cobertura mínima del 80%.

### 📚 Documentación OpenAPI
- Generación de documentación Swagger/OpenAPI.
- Interfaz visual interactiva para pruebas.

### 🔐 Roles y permisos
- Rol administrador y usuarios con permisos.
- Acceso a diferentes endpoints según rol.

---

Estas funcionalidades serán agregadas una vez se finalice el desarrollo completo del backend y frontend.
