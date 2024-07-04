#!/bin/bash

# Instala as dependências da aplicação
composer update

echo "------------------------------"
echo "---- SETANDO PERMISSOES ------"
echo "------------------------------"
chown -R www-data:www-data /var/www/html
chmod -R 755 /var/www/html/storage
chmod -R 755 /var/www/html/bootstrap

echo "------------------------------"
echo "------ FIM PERMISSOES --------"
echo "------------------------------"

echo "------------------------------"
echo "-------- PHP ARTISAN ---------"
echo "------------------------------"

php artisan storage:link
php artisan migrate:refresh --seed

echo "------------------------------"
echo "------ FIM PHP ARTISAN -------"
echo "------------------------------"

# Inicia o serviço do php apache dockerizado
apache2-foreground