FROM php:8.3-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files and install dependencies
COPY composer.json composer.lock ./
RUN composer install --ignore-platform-reqs --no-scripts --no-autoloader

# Copy the rest of the application
COPY . .

# Generate optimized autoloader and clear cache
RUN composer dump-autoload --optimize
RUN php artisan cache:clear

# Expose port
EXPOSE 9000

# Start PHP-FPM server
CMD ["php-fpm"]