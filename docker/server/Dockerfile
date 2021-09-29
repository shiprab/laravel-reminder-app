FROM studiographene/php-fpm7-nginx:7.4.16-fpm-alpine
COPY docker/server/nginx.conf /etc/nginx/conf.d/default.conf

COPY docker/server/php.ini /etc/php7/php.ini
COPY . /var/app/laravel-reminder-app

WORKDIR /var/app/laravel-reminder-app

USER root

COPY docker/server/php.ini /usr/local/etc/php/php.ini
RUN rm composer.lock
RUN rm -rf vendor
RUN composer clear-cache
RUN COMPOSER_MEMORY_LIMIT=-1 composer install --prefer-dist -vvv
RUN composer dump-autoload
RUN chown -R www-data:www-data /var/app/laravel-reminder-app/storage/logs
RUN chmod -R 775 /var/app/laravel-reminder-app/storage
RUN chmod -R 775 /var/app/laravel-reminder-app/bootstrap
RUN chmod -R 775 /var/app/laravel-reminder-app/public

RUN php /var/app/laravel-reminder-app/artisan route:clear