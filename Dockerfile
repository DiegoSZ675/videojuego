# Usar una imagen oficial de PHP con el servidor Apache
FROM php:8.2-apache

# Copiar los archivos de tu aplicación (index.php, conexion.php) al directorio del servidor
COPY . /var/www/html/

# Habilitar la extensión de PostgreSQL para que PHP pueda conectarse a Supabase
RUN docker-php-ext-install pdo pdo_pgsql pgsql
