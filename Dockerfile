# Use the official PHP image from Docker Hub
FROM php:7.4-apache

# Install necessary PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite for clean URLs
RUN a2enmod rewrite

# Set the ServerName directive to suppress the warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Set the DirectoryIndex to default to the home.php in the user folder
RUN echo "DirectoryIndex /var/www/html/user/home/home.php" >> /etc/apache2/apache2.conf

# Allow .htaccess overrides
RUN echo "<Directory /var/www/html/>" >> /etc/apache2/apache2.conf
RUN echo "    AllowOverride All" >> /etc/apache2/apache2.conf
RUN echo "</Directory>" >> /etc/apache2/apache2.conf

# Expose port 8080 for Railway or local access
EXPOSE 8080

# Start Apache and ensure it listens on port 8080
CMD ["apache2-foreground"]

# Ensure the environment variable is set to listen on port 8080
ENV APACHE_LISTEN 8080

# Copy your entire project folder into the container
COPY . /var/www/html/

# Set permissions to allow Apache access
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html
