# Use the official PHP image from Docker Hub
FROM php:7.4-apache

# Install necessary PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite for clean URLs
RUN a2enmod rewrite

# Set the ServerName directive to suppress the warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Allow .htaccess overrides
RUN echo "<Directory /var/www/html/>" >> /etc/apache2/apache2.conf
RUN echo "    AllowOverride All" >> /etc/apache2/apache2.conf
RUN echo "</Directory>" >> /etc/apache2/apache2.conf

# Set the default home page to your home.php file
RUN echo "DirectoryIndex /user/home/home.php" >> /etc/apache2/apache2.conf

# Expose port 8080 for Railway or local access
EXPOSE 8080

# Start Apache
CMD ["apache2-foreground"]
