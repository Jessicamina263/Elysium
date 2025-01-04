# Use the official PHP image from Docker Hub
FROM php:7.4-apache

# Install PHP extensions if needed (for example, MySQL or PDO extensions)
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy your application code into the container
COPY . /var/www/html/

# Set the working directory
WORKDIR /var/www/html/

# Expose the web service port (Apache on port 8080 for Railway)
EXPOSE 8080

# Start Apache in the background and make sure it listens on port 8080
CMD ["apache2-foreground"]

# Set the environment variable to listen on port 8080
ENV APACHE_LISTEN 8080
