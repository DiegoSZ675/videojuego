# Usar una imagen oficial de PHP 8.2 con Apache
FROM php:8.2-apache

# Actualizar el sistema e instalar las dependencias de sistema para PostgreSQL
# 'libpq-dev' es la librería de cliente de PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar las extensiones de PHP que necesitamos: pdo y pdo_pgsql
RUN docker-php-ext-install pdo pdo_pgsql

# Copiar todos tus archivos PHP (index.php, login.php, etc.)
# al directorio web por defecto de Apache
COPY . /var/www/html/
