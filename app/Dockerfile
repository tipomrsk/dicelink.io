FROM php:8.3-apache

WORKDIR /var/www

# Instala as dependências
RUN apt-get update
RUN apt-get install -y unzip zip wget nano curl libicu-dev libzip-dev

RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install zip
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl


# Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Habilita os módulos do Apache necessários
RUN a2enmod rewrite

# Configure o DocumentRoot do Apache para apontar para o diretório de trabalho do Laravel
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Define o diretório de trabalho dentro do contêiner
WORKDIR /var/www/html

# Copia o código do aplicativo Laravel para o diretório de trabalho
COPY . /var/www/html

# Define as permissões necessárias para o diretório de armazenamento do Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Exponha a porta 80 para acessar o aplicativo via navegador
EXPOSE 80