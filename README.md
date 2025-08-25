# Ejecutar Proyecto Laravel

## Requisitos
- PHP >= 8.1
- Composer
- MySQL / PostgreSQL

## Instalación
git clone <URL>

cd tareas-usuarios

composer install

cp .env.example .env

php artisan key:generate

## Configuración
- Editar .env con credenciales DB
- Definir API_TOKEN en .env

## Migraciones y seeders
php artisan migrate --seed

## Servidor
php artisan serve
URL: http://127.0.0.1:8000

## Pruebas
php artisan test

## Endpoints principales
GET /api/users
GET /api/users/{id}/tasks
POST /api/tasks
PUT /api/tasks/{id}
DELETE /api/tasks/{id}

## Autenticación (Definir token en .env API_TOKEN)
Header: Authorization: Bearer 
