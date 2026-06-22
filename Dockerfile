FROM php:8.2-apache

# Instalar la extensión PDO MySQL para tu base de datos
RUN docker-php-ext-install pdo pdo_mysql

# Cambiar el documento raíz de Apache a la carpeta public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Habilitar el módulo de reescritura de Apache para tus rutas
RUN a2enmod rewrite

# Copiar todo el código de tu proyecto al servidor
COPY . /var/www/html/

# Darle permisos correctos a los archivos
RUN chown -R www-data:www-data /var/www/html