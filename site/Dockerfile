FROM php:8.2-apache

# Installez le client PostgreSQL et configurez l'extension
RUN apt-get update && \
    apt-get install -y libpq-dev && \
    docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
    docker-php-ext-install pdo pdo_pgsql pgsql && \
    docker-php-ext-install pdo_pgsql

# Installez d'autres dépendances
RUN apt-get install -y libpng-dev libfreetype6-dev libyaml-dev && \
    apt install -y systemctl

# Configurez et installez l'extension GD
RUN docker-php-ext-configure gd --with-freetype && \
    docker-php-ext-install gd

# Installez l'extension YAML avec PECL
RUN pecl install yaml

# Configurez Apache
RUN a2enmod rewrite

# Exposez les ports
EXPOSE 80
EXPOSE 443

# Modifiez l'ID de l'utilisateur www-data
RUN usermod -u 1000 www-data
