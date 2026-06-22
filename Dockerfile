FROM php:8.2-fpm-alpine

# Instalamos Apache y los módulos necesarios
RUN apk add --no-cache apache2 apache2-proxy php82-apache2

# Instalamos extensiones de PHP necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Configuramos Apache para usar PHP-FPM
# Copiamos un archivo de configuración mínimo que no tenga conflictos de MPM
RUN echo 'LoadModule mpm_event_module modules/mod_mpm_event.so' > /etc/apache2/conf.d/mpm.conf && \
    echo 'LoadModule proxy_module modules/mod_proxy.so' >> /etc/apache2/conf.d/mpm.conf && \
    echo 'LoadModule proxy_fcgi_module modules/mod_proxy_fcgi.so' >> /etc/apache2/conf.d/mpm.conf

# Copiamos tus archivos
COPY . /var/www/html/

# Ajustamos la raíz a la carpeta 'public'
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/httpd.conf

# Permisos
RUN chown -R apache:apache /var/www/html

EXPOSE 80

# Comando para iniciar Apache en primer plano
CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]