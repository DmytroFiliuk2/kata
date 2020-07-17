FROM php:7.4-apache
COPY Text Analyzer/ /var/www/html/
RUN  pecl install xdebug-2.8.1