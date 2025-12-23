# Base image PHP + Apache
FROM php:8.2-apache

# Copy project files to Apache directory
COPY . /var/www/html/

# Enable mod_rewrite (if needed)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html/
