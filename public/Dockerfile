FROM php:8.2-apache

COPY . /var/www/html/

RUN a2enmod rewrite

RUN echo '<Directory /var/www/html/public>\n\
    AllowOverride All\n\
</Directory>' >> /etc/apache2/apache2.conf

RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

EXPOSE 80