#!/bin/bash
set -x

cd /var/www/medieval-europe/public_html/application/libraries/vendors/PHPMailer
php5.6 /usr/bin/composer require league/oauth2-google

cd /var/www/medieval-europe/public_html/application/models
php5.6 /usr/bin/composer require league/oauth2-google

sleep 10

service apache2 start
service mysql start
service memcached start

mysql -u root << END
CREATE USER 'medievaleurope'@'localhost' IDENTIFIED BY 'ThisIsAPassword!1';
GRANT ALL PRIVILEGES ON *.* TO 'medievaleurope'@'localhost';
FLUSH PRIVILEGES;
END
mysql < /var/www/medieval-europe/sql/structure.sql
mysql < /var/www/medieval-europe/sql/core_data.sql

php5.6 /var/www/medieval-europe/public_html/database/scripts/Jdemolay/03.\ Reset_Server.php

# This is run as a docker CMD so we just sleep forever
while true; do sleep 1000; done
