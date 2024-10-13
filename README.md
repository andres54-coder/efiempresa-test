# API Documentation

Esta documentación describe las rutas y funcionalidades de la API definidas en el archivo [`api.php`](routes/api.php).

## Rutas Públicas

### Obtener Usuario Actual
- **Ruta:** `GET /user`
- **Descripción:** Retorna la información del usuario autenticado.
- **Middleware:** `auth:api`

### Autenticación

#### Iniciar Sesión
- **Ruta:** `POST /auth/login`
- **Controlador:** `AuthController@login`

#### Registro
- **Ruta:** `POST /register`
- **Controlador:** `AuthController@register`

## Rutas Protegidas

### Autenticación (Protegidas)
- **Prefijo:** `/auth`
- **Middleware:** `auth:api`

#### Cerrar Sesión
- **Ruta:** `POST /auth/logout`
- **Controlador:** `AuthController@logout`

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
