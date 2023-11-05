# Use a imagem oficial do PHP
FROM php:8.2-fpm

# Atualize os pacotes e instale as dependências necessárias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

RUN apt-get update && docker-php-ext-install pdo_mysql

# Instale o Composer globalmente
#RUN curl -sS https://getcomposer.org/installer | php
#-- --install-dir=/usr/local/bin --filename=composer

# Install composer
# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer



ENV COMPOSER_ALLOW_SUPERUSER=1

RUN set -eux

# Configure o usuário do PHP-FPM para corresponder ao usuário no seu sistema local
RUN usermod -u 1000 www-data

RUN chmod -R 755 /var/*

# Defina o diretório de trabalho como a raiz
WORKDIR /

# Copie os arquivos do aplicativo Laravel para o contêiner
COPY . .

# Instale as dependências do Composer
RUN cd /var/www/

RUN composer update --no-scripts

RUN composer install

EXPOSE 9000

RUN cd /var/www/

CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port=9000"]
