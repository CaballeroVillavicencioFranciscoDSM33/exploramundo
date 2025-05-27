
# ExploraMundo - Sistema de Reservas de Actividades Turísticas

ExploraMundo es una aplicación web desarrollada con Laravel 12, que permite a usuarios explorar actividades turísticas, realizar reservas, y a administradores gestionar dichas actividades y promociones. Incluye panel administrativo con plantilla AdminLTE 3, validaciones completas, gestión de imágenes, buscador interactivo y tests automatizados.

---

## Contenido

1. Requisitos
2. Instalación del proyecto
3. Configuración
4. Migraciones y seeders
5. Funcionalidades implementadas
6. Panel administrativo
7. Vista pública
8. Autenticación y autorizaciones
9. Pruebas automáticas
10. Consideraciones adicionales
11. Autor

---

## 1. Requisitos

- PHP >= 8.2
- Composer
- MySQL o MariaDB
- Node.js y NPM
- Laravel 12
- Servidor local como Laragon, Valet, XAMPP, etc.
- Navegador moderno

---

## 2. Instalación del proyecto

### Opción A: Usando archivo ZIP (entregado)

1. Descomprime el archivo `reservas-actividades.zip` en tu servidor local o carpeta de desarrollo.
2. Abre una terminal en la carpeta descomprimida.
3. Ejecuta:

```bash
composer install
npm install
npm run build
cp .env.example .env
php artisan key:generate
php artisan storage:link
```

4. Configura la base de datos en `.env` (ver paso 3).
5. Ejecuta migraciones y seeders (ver paso 4).

---

### Opción B: Clonar desde repositorio (si aplica)

```bash
git clone https://github.com/CaballeroVillavicencioFranciscoDSM33/exploramundo.git
cd exploramundo
composer install
npm install
npm run build
cp .env.example .env
php artisan key:generate
php artisan storage:link
```

## 3. Configuración

```bash
php artisan key:generate
```

Edita el archivo `.env` para agregar los datos de tu base de datos:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=exploramundo
DB_USERNAME=root
DB_PASSWORD=
```

Crea el enlace simbólico para las imágenes:

```bash
php artisan storage:link
```

---

## 4. Migraciones y seeders

```bash
php artisan migrate --seed
```

Esto crea:

- Usuario administrador: **admin@demo.com / password**
- Usuario normal: **user@demo.com / password**
- Actividades, promociones y reservas de ejemplo

## Cuenta Usuario

- user@example.com
- password

## Cuenta Admin

- admin@example.com
- password

## 5. Funcionalidades implementadas

- Registro y login de usuarios (Laravel Breeze)
- CRUD de actividades con imagen, fechas, popularidad y validación
- CRUD de promociones con estado y banner dinámico
- Panel administrativo con AdminLTE 3
- Validación cruzada de fechas en frontend y backend
- Control de reservas con validación por fecha y cantidad
- Relación de actividades relacionadas
- Popularidad automática al reservar
- Vista pública con buscador por fecha, personas y precio
- Vista de reservas del usuario autenticado
- Vista de reservas para el administrador
- Imagen con vista previa en formulario
- SweetAlert para confirmaciones visuales
- Tests unitarios y funcionales

---

## 6. Panel administrativo

URL: `/admin/dashboard`

Acceso restringido a administradores.

### Funcionalidades:

- Dashboard con estadísticas
- CRUD de actividades
- CRUD de promociones (con imagen)
- Visualización de todas las reservas
- Navegación clara y diseño responsive

---

## 7. Vista pública

URL principal: `/`

- Carrusel dinámico de promociones activas
- Buscador interactivo con filtros de fecha, personas y precio
- Listado de actividades con paginación
- Vista de detalle con actividades relacionadas
- Reserva protegida por login
- Visualización de reservas del usuario

---

## 8. Autenticación y autorizaciones

- Usuarios normales:
  - Reservar actividades
  - Ver historial de reservas
- Administradores:
  - Gestionar actividades y promociones
  - Ver todas las reservas

Las rutas están protegidas con middlewares personalizados (`auth`, `admin`).

---

## 9. Pruebas automáticas

```bash
php artisan test
```

Se incluyen pruebas con PHPUnit y Laravel Test Framework:

- Acceso a panel admin
- Búsqueda de actividades
- Creación de reservas válidas
- Bloqueo de reservas inválidas
- Validaciones de formularios
- Gestión de perfil de usuario

---

## 10. Consideraciones adicionales

- Asegúrate de correr `php artisan storage:link` para las imágenes
- Usa `.env.testing` con una base MySQL separada para pruebas
- El sistema valida fechas en formularios y en backend
- Todas las vistas usan componentes de Blade y Bootstrap
- Los botones usan SweetAlert para una mejor experiencia visual

---

## 11. Autor

**Francisco Caballero Villavicencio**  
Proyecto técnico Laravel 12 - 2025  
Contacto: al222111282@gmail.com

---

Gracias por probar *ExploraMundo*. ¡Explora y reserva experiencias inolvidables!
