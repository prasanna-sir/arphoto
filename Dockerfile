# Use an official PHP image with Apache as the base image
FROM php:8.2-apache

# Install system dependencies and PHP extensions required by Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libxml2-dev \
    unzip \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_sqlite zip bcmath ctype fileinfo mbstring tokenizer xml

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory
WORKDIR /var/www/html

# Copy the application code, database, and images
COPY . .
COPY database/database.sqlite /var/www/html/database/database.sqlite
COPY storage/app/public /var/www/html/storage/app/public

# Set permissions for the database and images
RUN chown -R www-data:www-data /var/www/html/database /var/www/html/storage/app/public
RUN chmod -R 664 /var/www/html/database/database.sqlite
RUN chmod -R 644 /var/www/html/storage/app/public/images
RUN chmod -R 755 /var/www/html/storage/app/public

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Create the storage link
RUN php artisan storage:link

# Enable Apache rewrite module (required for Laravel routing)
RUN a2enmod rewrite

# Configure Apache to use the public directory as the document root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Expose port 8080 (Render uses this port for Docker services)
EXPOSE 8080

# Start Apache
CMD ["apache2-foreground"]