# Use the official PHP image with Apache and extensions
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libicu-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install intl gd pdo_mysql opcache zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer globally
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Copy project files
COPY . .

# Copy custom Apache configuration
COPY docker/apache/symfony.conf /etc/apache2/sites-available/000-default.conf

# Install PHP dependencies
RUN composer install --no-scripts --no-progress --prefer-dist

# Build frontend assets
RUN npm install && npm run build

# Set permissions
RUN chown -R www-data:www-data /var/www/html/var /var/www/html/public /var/www/html/vendor

COPY  docker/docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh

RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Set the entrypoint script
#ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]


# Expose default web server port
EXPOSE 8080