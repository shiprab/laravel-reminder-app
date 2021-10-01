FROM public.ecr.aws/k5e9i6a2/php-fpm-nginx:7.4.16-alpine
COPY local/nginx.conf /etc/nginx/conf.d/default.conf
#COPY local/php.ini /etc/php7/php.ini
COPY . /var/app/reminderapp
WORKDIR /var/app/reminderapp
USER root
RUN composer self-update
RUN composer config -g github-oauth.github.com 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
RUN composer install --prefer-dist --ignore-platform-reqs -vvv
RUN composer dump-autoload
RUN chown -R www-data:www-data /var/app/reminderapp/storage/logs
RUN chmod -R 775 /var/app/reminderapp/storage
RUN chmod -R 775 /var/app/reminderapp/bootstrap
RUN chmod -R 775 /var/app/reminderapp/public
RUN php /var/app/reminderapp/artisan route:clear
#RUN php /var/app/reminderapp/artisan l5-swagger:generate

RUN php /var/app/reminderapp/artisan optimize
RUN chmod -R 777 storage public bootstrap/cache
CMD ["/bin/sh", "-c", "nginx && php-fpm"]