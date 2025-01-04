# Use the official PHP image from Docker Hub
FROM php:7.4-apache

# Install PHP extensions if needed (for example, MySQL or PDO extensions)
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite for clean URLs
RUN a2enmod rewrite

# Set the ServerName directive to suppress the warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Set the DirectoryIndex to default to the home.php in the user folder
RUN echo "DirectoryIndex /restaurant/user/home/home.php" >> /etc/apache2/apache2.conf

# Set the DocumentRoot to serve files from /restaurant/user/home
RUN echo "DocumentRoot /var/www/html/restaurant/user/home" >> /etc/apache2/sites-available/000-default.conf

# Allow access to the /restaurant/user/home directory
RUN echo "<Directory /var/www/html/restaurant/user/home>" >> /etc/apache2/apache2.conf
RUN echo "    AllowOverride All" >> /etc/apache2/apache2.conf
RUN echo "    Require all granted" >> /etc/apache2/apache2.conf
RUN echo "</Directory>" >> /etc/apache2/apache2.conf

# Allow .htaccess overrides in other parts of the application
RUN echo "<Directory /var/www/html/restaurant>" >> /etc/apache2/apache2.conf
RUN echo "    AllowOverride All" >> /etc/apache2/apache2.conf
RUN echo "</Directory>" >> /etc/apache2/apache2.conf

# Copy the project files into the container
COPY . /var/www/html/

# Ensure the files have the right permissions
RUN chmod -R 755 /var/www/html/restaurant/user/home

# Set the working directory
WORKDIR /var/www/html/

# Expose port 8080 for Railway or local access
EXPOSE 8080

# Start Apache and make sure it listens on port 8080
CMD ["apache2-foreground"]

# Ensure the environment variable is set to listen on port 8080
ENV APACHE_LISTEN 8080
