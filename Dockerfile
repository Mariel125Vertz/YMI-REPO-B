# Usamos una imagen que ya trae Nginx y PHP-FPM configurados profesionalmente
FROM trafex/alpine-php82:latest

# Copiamos tus archivos
COPY . /var/www/html/

# IMPORTANTE: Configuramos Nginx para que apunte a la carpeta 'public'
# En esta imagen, el archivo de configuración de Nginx está aquí:
RUN sed -i 's|root /var/www/html;|root /var/www/html/public;|g' /etc/nginx/nginx.conf

# Damos permisos
USER root
RUN chown -R nobody:nobody /var/www/html
USER nobody

EXPOSE 8080