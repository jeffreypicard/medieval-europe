#!/bin/bash
set -x
service apache2 start
service mysql start
service memcached start

mysql -u root << END
GRANT ALL PRIVILEGES ON *.* TO 'medievaleurope'@'localhost';
FLUSH PRIVILEGES;
END
mysql < /var/www/medieval-europe/sql/structure.sql
mysql < /var/www/medieval-europe/sql/core_data.sql

php5.6 /var/www/medieval-europe/public_html/database/scripts/Jdemolay/03.\ Reset_Server.php

# This is run as a docker CMD so we just sleep forever
while true; do sleep 1000; done
