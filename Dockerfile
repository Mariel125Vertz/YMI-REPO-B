FROM php:8.2-cli

RUN apt-get update && apt-get install -y git unzip libzip-dev \
    && docker-php-ext-install mysqli pdo pdo_mysql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiamos todo lo que está en la raíz a /var/www/html
COPY . /var/www/html
WORKDIR /var/www/html

# Instalamos dependencias (ahora sí encontrará el composer.json en la raíz)
RUN composer install --no-dev --optimize-autoloader

EXPOSE 8080

# IMPORTANTE: Si tus archivos están en 'backend', ajusta la ruta del index
# Si tu index.php está en 'public', asegúrate que la ruta sea correcta:
CMD ["php", "-S", "0.0.0.0:8080", "-t", "/var/www/html/public", "/var/www/html/public/index.php"]