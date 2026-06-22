FROM php:8.2-fpm

RUN apt-get update && apt-get install -y debian-archive-keyring apt-transport-https curl && \
    curl -1sLf 'https://dl.cloudsmith.io/public/caddy/stable/gpg.key' | gpg --dearmor -o /usr/share/keyrings/caddy-stable-archive-keyring.gpg && \
    curl -1sLf 'https://dl.cloudsmith.io/public/caddy/stable/debian.deb.txt' | tee /etc/apt/sources.list.d/caddy-stable.list && \
    apt-get update && apt-get install -y caddy

COPY . /app/

WORKDIR /app

EXPOSE 8080

CMD php-fpm && caddy run --config /app/Caddyfile --adapter caddyfile