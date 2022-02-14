FROM php:8.0-apache

COPY ./ /var/www/html/

ENTRYPOINT ["php", "./index.php"]
