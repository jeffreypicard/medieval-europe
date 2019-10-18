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
