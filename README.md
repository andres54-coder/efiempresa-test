<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Para optener mas detalle sobre la api (tipo,parametros) ejecutar:
 ```shell
php artisan route:list --path=api
```

# API Documentation

Esta documentación describe las rutas y funcionalidades de la API definidas en el archivo [`api.php`](routes/api.php).
- **Anadir como header :** `Accept : 'application/json'`
## Rutas Públicas

### Obtener Usuario Actual
- **Ruta:** `GET /user`
- **Descripción:** Retorna la información del usuario autenticado.
- **Middleware:** `auth:api`

### Autenticación

#### Registro
- **Ruta:** `POST /register`
- **Controlador:** `AuthController@register`
- **Datos de entrada:**
 ```json
{
  "name" : "test",
  "email" : "test@test",
  "password" : "andres"
}
```
- **Respuesta:**
 ```json
{
    "name": "test",
    "email": "test@test",
    "updated_at": "2024-10-13T23:08:34.000000Z",
    "created_at": "2024-10-13T23:08:34.000000Z",
    "id": 1
}
```

#### Iniciar Sesión
- **Ruta:** `POST /auth/login`
- **Controlador:** `AuthController@login`
- **Datos de entrada:**
 ```json
{
  "email" : "test@test",
  "password" : "andres"
}
```
- **Respuesta:**
 ```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3Lj...",
    "token_type": "bearer",
    "expires_in": 3600
}
```

## Rutas Protegidas
- **Anadir como header :** `Authorization : 'Bearer <Bearer token>'`
- **Anadir como header :** `Accept : 'application/json'`
### Autenticación (Protegidas)
- **Prefijo:** `/auth`
- **Middleware:** `auth:api`

#### Cerrar Sesión
- **Ruta:** `POST /auth/logout`
- **Controlador:** `AuthController@logout`

- **Respuesta:**
 ```json
{
    "message": "Successfully logged out"
}
```
#### Refrescar Token
- **Ruta:** `POST /auth/refresh`
- **Controlador:** `AuthController@refresh`

#### Obtener Información del Usuario
- **Ruta:** `POST /auth/me`
- **Controlador:** `AuthController@me`

### Productos

#### Listar Productos
- **Ruta:** `GET /products`
- **Controlador:** `ProductController@index`

#### CRUD de Productos (Excepto Listar)
- **Prefijo:** `/products`
- **Middleware:** `auth:api`
- **Controlador:** `ProductController`

### Impuestos

#### CRUD de Impuestos
- **Prefijo:** `/taxes`
- **Middleware:** `auth:api`
- **Controlador:** `TaxController`

### Carritos

#### Añadir Producto al Carrito
- **Ruta:** `POST /cart/add-product/{cart?}`
- **Middleware:** `auth:api`
- **Controlador:** `CartController@addProduct`

#### Calcular Total del Carrito
- **Ruta:** `GET /carts/{cart}/calculate-total`
- **Middleware:** `auth:api`
- **Controlador:** `CartController@calculateTotal`

#### Mostrar Carrito
- **Ruta:** `GET /carts/{cart}`
- **Middleware:** `auth:api`
- **Controlador:** `CartController@show`
