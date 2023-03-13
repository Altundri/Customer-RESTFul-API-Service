FROM php:7.4-apache

# Copy files to container
COPY . /var/www/html/

# Install dependencies
RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        zip \
        unzip \
        git \
        curl && \
    docker-php-ext-install pdo_mysql zip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel dependencies
WORKDIR /var/www/html
RUN composer install

# Set up Apache
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

RUN a2enmod rewrite

# Expose port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
