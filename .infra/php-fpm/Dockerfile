# Desenvolvimento
FROM php:7.4.4-fpm-alpine3.11 AS development

ENV USER_UID=1000
ARG USER_UID=1000

WORKDIR /var/www

RUN rm -rf /var/www/html \
    && apk add --no-cache openssl bash nano mysql-client nginx shadow supervisor \
    && docker-php-ext-install pdo pdo_mysql bcmath \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && usermod -u ${USER_UID} www-data \
    && groupmod -g ${USER_UID} www-data


COPY ./.infra/php-fpm/php.ini /usr/local/etc/php/conf.d/php.override.ini
COPY ./.infra/php-fpm/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./.infra/php-fpm/default.conf /etc/nginx/conf.d/default.conf
COPY ./.infra/php-fpm/nginx.conf /etc/nginx/nginx.conf
COPY ./.infra/php-fpm/supervisord.ini /etc/supervisor.d/services.ini

COPY ./.infra/php-fpm/entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh

COPY --chown=www-data:www-data ./ ./

RUN composer install \
    && php artisan package:discover --ansi \
    && if [[ ! -d ./vendor ]]; then php artisan key:generate --ansi; fi \
    && php artisan config:clear

EXPOSE 80

ENTRYPOINT exec /usr/bin/supervisord -n -c /etc/supervisord.conf
