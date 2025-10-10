# Usar una imagen oficial de PHP con el servidor Apache
FROM php:8.2-apache

# Copiar los archivos de tu aplicación
COPY . /var/www/html/

# NUEVO PASO: Instalar la librería de desarrollo de PostgreSQL
RUN apt-get update && apt-get install -y libpq-dev

# Este comando ahora funcionará gracias al paso anterior
RUN docker-php-ext-install pdo pdo_pgsql pgsql
