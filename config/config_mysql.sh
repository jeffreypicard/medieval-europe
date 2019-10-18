#!/bin/bash
set -x

mysql -u root << END
GRANT ALL PRIVILEGES ON *.* TO 'medievaleurope'@'localhost';
FLUSH PRIVILEGES;
END
mysql < /medieval-europe/sql/structure.sql
mysql < /medieval-europe/sql/core_data.sql
