#!/bin/bash
set -x

if [ -f "/home/vagrant/medieval-europe/.init_ran" ]; then
	echo "Init already run, exiting"
	exit 0
fi

mkdir -p /home/vagrant/medieval-europe/public_html/upload
mkdir -p /home/vagrant/medieval-europe/public_html/application/logs

cd /home/vagrant/medieval-europe/public_html/application/libraries/vendors/PHPMailer
composer require league/oauth2-google

cd /home/vagrant/medieval-europe/public_html/application/models
composer require league/oauth2-google

sleep 10

sudo bash -c 'echo "sql_mode=\"STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION\"" >> /etc/mysql/mysql.conf.d/mysqld.cnf'

#service apache2 start
#service mysql start
#service memcached start

mysql -u root << END
CREATE USER 'medievaleurope'@'localhost' IDENTIFIED BY 'ThisIsAPassword!1';
GRANT ALL PRIVILEGES ON *.* TO 'medievaleurope'@'localhost';
FLUSH PRIVILEGES;
END
mysql < /home/vagrant/medieval-europe/sql/structure.sql
mysql < /home/vagrant/medieval-europe/sql/core_data.sql

php /home/vagrant/medieval-europe/public_html/database/scripts/Jdemolay/03.\ Reset_Server.php

touch /home/vagrant/medieval-europe/.init_ran
