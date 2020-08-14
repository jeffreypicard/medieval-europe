#!/bin/bash
set -x

cd /var/www/medieval-europe/public_html/application/libraries/vendors/PHPMailer
php /usr/bin/composer require league/oauth2-google

cd /var/www/medieval-europe/public_html/application/models
php /usr/bin/composer require league/oauth2-google

sleep 10

echo 'sql_mode="STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION"' >> /etc/mysql/mysql.conf.d/mysqld.cnf

service apache2 start
service mysql start
#service memcached start

mysql -u root << END
CREATE USER 'medievaleurope'@'localhost' IDENTIFIED BY 'ThisIsAPassword!1';
GRANT ALL PRIVILEGES ON *.* TO 'medievaleurope'@'localhost';
FLUSH PRIVILEGES;
END
mysql < /var/www/medieval-europe/sql/structure.sql
mysql < /var/www/medieval-europe/sql/core_data.sql

php /var/www/medieval-europe/public_html/database/scripts/Jdemolay/03.\ Reset_Server.php

# This is run as a docker CMD so we just sleep forever
while true; do sleep 1000; done
