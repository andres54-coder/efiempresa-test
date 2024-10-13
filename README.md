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
- **Ruta:** `POST /carts/{cart}/add-product`
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
