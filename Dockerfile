# Usamos una imagen base optimizada con Nginx y PHP-FPM
FROM trafex/alpine-php82:latest

# Copiamos todo el contenido de tu repositorio al directorio web
COPY . /var/www/html/

# Configuramos Nginx para que el 'Document Root' sea la carpeta /public
# Esto es equivalente a lo que intentábamos hacer con Apache
USER root
RUN sed -i 's|root /var/www/html;|root /var/www/html/public;|g' /etc/nginx/nginx.conf

# Ajustamos los permisos para el usuario 'nobody' que usa esta imagen
RUN chown -R nobody:nobody /var/www/html

USER nobody

# Exponemos el puerto estándar
EXPOSE 8080