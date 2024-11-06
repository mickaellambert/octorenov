# Use PHP image with Apache
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    libzip-dev \
    libpng-dev \
    && docker-php-ext-install intl zip pdo pdo_mysql

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set the working directory
WORKDIR /var/www/html

# Copy application source code into the container
COPY . /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set permissions and switch to non-root user before running composer install
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Switch to www-data user for composer install
USER www-data

# Install dependencies for Symfony as non-root user
RUN composer install --optimize-autoloader --no-interaction

# Revert to root user to complete remaining setup tasks
USER root

# Configure DocumentRoot to the public folder
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

RUN echo "<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>" >> /etc/apache2/apache2.conf