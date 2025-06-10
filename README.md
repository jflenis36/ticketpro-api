
# 🎯 TicketPro API - Backend (Laravel)

Este repositorio contiene el backend del proyecto **TicketPro**, una aplicación para la gestión de incidencias/tickets de soporte técnico. El backend está desarrollado en **Laravel** e implementa una API RESTful para interactuar con el frontend desarrollado en Vue.js.

---

## 📌 Objetivo del Proyecto

Desarrollar una plataforma funcional y visualmente atractiva para la gestión de tickets de soporte. El objetivo principal es resolver la prueba técnica propuesta por **Iyata SAS**, cumpliendo con buenas prácticas de arquitectura y desarrollo.

---

## ⏳ Alcance y Plazos

- ⏱ Tiempo estimado: 7 a 10 días
- 🧩 Funcionalidades principales:
  - Registro e inicio de sesión (con **Laravel Sanctum**)
  - Crear, editar, listar y eliminar tickets
  - Asignar estados a los tickets (Abierto, En proceso, Cerrado)
  - API REST consumida desde el frontend

---

## 🚧 Estado del Proyecto

| Fecha       | Descripción                                      |
|-------------|--------------------------------------------------|
| Día 1       | Proyecto creado con Laravel. Se instaló Sanctum.|
| Día 2       | Integración de autenticación y migraciones iniciales. |
| Día 3       | CRUD de tickets y configuración de rutas API.   |

---

## 🛠️ Tecnologías

- Laravel 11
- Sanctum (Auth API)
- MySQL / SQLite (según entorno)
- PHP 8.2+

---

## 📂 Estructura del Repositorio

```
ticketpro-api/
├── app/
├── config/
├── database/
├── routes/
│   └── api.php
├── .env.example
└── README.md
```

---

## 📫 Contacto

**Juan Lenis**  
Desarrollador Full Stack
[LinkedIn](https://www.linkedin.com/in/jflenis36)


----------------------------------------

# ⏳ Proceos

----------------------------------------

## 🎫 Endpoints - Gestión de Tickets

Todas las rutas están protegidas mediante autenticación con **Sanctum**. Requiere un token válido tipo **Bearer**.

### 📌 Base: `/api/ticket`

---

### 🔍 `GET /api/ticket`
**Descripción:** Listar los tickets del usuario autenticado (orden descendente por fecha).

**Respuesta exitosa:**
```json
{
  "ok": true,
  "status": "success",
  "code": 200,
  "message": "Operación exitosa.",
  "data": [ /* Lista de tickets */ ]
}
```


## ✅ Autenticación con Laravel Sanctum

Se ha implementado un sistema de autenticación seguro y estructurado utilizando Laravel Sanctum. Este módulo incluye los siguientes endpoints:

### 🔐 Endpoints

- `POST /api/auth/register`: Registro de usuario con validación de campos (`name`, `email`, `password`, `password_confirmation`).
- `POST /api/auth/login`: Inicio de sesión con retorno de token de acceso.
- `POST /api/auth/logout`: Cierre de sesión y revocación de todos los tokens del usuario.
- `GET /api/user`: Retorna la información del usuario autenticado (protegido con middleware `auth:sanctum`).

---

### 📦 Validaciones y mensajes personalizados

- Todos los errores de validación son retornados en **español** con mensajes claros y amigables.
- Se unificó la estructura de las respuestas para que mantengan el siguiente formato en toda la API:

```json
{
  "ok": false,
  "status": "error",
  "code": 422,
  "message": "El campo email es obligatorio. El campo password es obligatorio.",
  "errors": null
}
```

