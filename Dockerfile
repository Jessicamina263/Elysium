# Use the official PHP image from Docker Hub
FROM php:7.4-apache

# Install PHP extensions if needed (for example, MySQL or PDO extensions)
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set the ServerName directive to suppress the warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Modify Apache config to listen on port 8080
RUN sed -i 's/80/8080/' /etc/apache2/ports.conf
RUN sed -i 's/:80>/:8080>/' /etc/apache2/sites-available/000-default.conf

# Copy your application code into the container
COPY . /var/www/html/

# Set the working directory
WORKDIR /var/www/html/

# Expose port 8080 for Railway
EXPOSE 8080

# Start Apache and make sure it listens on port 8080
CMD ["apache2-foreground"]

# Ensure the environment variable is set to listen on port 8080
ENV APACHE_LISTEN 8080