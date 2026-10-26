FROM php:8.1-apache

# Install network diagnostic tools
RUN apt-get update \
    && apt-get install -y --no-install-recommends net-tools iproute2 \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite and set document root
RUN a2enmod rewrite
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copy vulnerable PHP app
COPY src/ /var/www/html/
COPY php.ini /usr/local/etc/php/

# Expose port and start Apache
EXPOSE 80
CMD ["apache2-foreground"]