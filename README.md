<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

<<<<<<< HEAD
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
=======
In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).
>>>>>>> parent of 2a351f5 (readme)

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

<<<<<<< HEAD
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

---

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
=======
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
>>>>>>> parent of 2a351f5 (readme)
