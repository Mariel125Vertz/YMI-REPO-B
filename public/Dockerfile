FROM php:8.2-fpm

RUN apt-get update && apt-get install -y caddy

COPY . /app/

WORKDIR /app

EXPOSE 8080

CMD php-fpm -D && caddy run --config /app/Caddyfile