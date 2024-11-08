# Etapa de construcción
FROM php:8.1-fpm

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    nginx \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libonig-dev \
    libzip-dev \
    zip \
    unzip

# Instalar extensiones de PHP
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar el directorio de trabajo
WORKDIR /var/www

# Copiar los archivos del proyecto
COPY . .

# Instalar las dependencias de PHP
RUN composer install

# Copiar el archivo de configuración de Nginx
COPY ./nginx.conf /etc/nginx/conf.d/default.conf

# Exponer el puerto 80
EXPOSE 80

# Arrancar Nginx y PHP-FPM
CMD ["sh", "-c", "service nginx start && php-fpm"]
