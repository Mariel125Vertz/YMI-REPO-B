FROM php:8.2-apache

COPY . /var/www/html/

RUN a2enmod rewrite

RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

RUN sed -i '/<\/VirtualHost>/i \
    <Directory /var/www/html/public>\
        AllowOverride All\
        Require all granted\
    </Directory>' /etc/apache2/sites-available/000-default.conf

RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf
RUN sed -i 's/<VirtualHost \*:80>/<VirtualHost *:8080>/' /etc/apache2/sites-available/000-default.conf

EXPOSE 8080