FROM public.ecr.aws/k5e9i6a2/php-fpm-nginx:7.4.16-alpine
COPY local/nginx.conf /etc/nginx/conf.d/default.conf
#COPY local/php.ini /etc/php7/php.ini
COPY . /var/app/laravel-reminder-app
WORKDIR /var/app/laravel-reminder-app
USER root
RUN composer self-update
RUN composer config -g github-oauth.github.com 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
RUN composer install --prefer-dist --ignore-platform-reqs -vvv
RUN composer dump-autoload
RUN chown -R www-data:www-data /var/app/laravel-reminder-app/storage/logs
RUN chmod -R 775 /var/app/laravel-reminder-app/storage
RUN chmod -R 775 /var/app/laravel-reminder-app/bootstrap
RUN chmod -R 775 /var/app/laravel-reminder-app/public
RUN php /var/app/laravel-reminder-app/artisan route:clear
#RUN php /var/app/laravel-reminder-app/artisan l5-swagger:generate

RUN php /var/app/laravel-reminder-app/artisan optimize
RUN chmod -R 777 storage public bootstrap/cache
CMD ["/bin/sh", "-c", "nginx && php-fpm"]