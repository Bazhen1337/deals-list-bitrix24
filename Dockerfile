FROM php:8.2-apache

# Устанавливаем необходимые расширения
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Включаем mod_rewrite
RUN a2enmod rewrite

# Копируем файлы приложения
COPY . /var/www/html/

# Устанавливаем правильные права
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

EXPOSE 80