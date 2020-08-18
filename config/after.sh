#!/bin/sh

# If you would like to do some extra provisioning you may
# add any commands you wish to this file and they will
# be run after the Homestead machine is provisioned.
#
# If you have user-specific configurations you would like
# to apply, you may also create user-customizations.sh,
# which will be run after this script.

# If you're not quite ready for Node 12.x
# Uncomment these lines to roll back to
# v11.x or v10.x

# Remove Node.js v12.x:
#sudo apt-get -y purge nodejs
#sudo rm -rf /usr/lib/node_modules/npm/lib
#sudo rm -rf //etc/apt/sources.list.d/nodesource.list

# Install Node.js v11.x
#curl -sL https://deb.nodesource.com/setup_11.x | sudo -E bash -
#sudo apt-get install -y nodejs

# Install Node.js v10.x
#curl -sL https://deb.nodesource.com/setup_10.x | sudo -E bash -
#sudo apt-get install -y nodejs
sudo service postgresql stop

sudo a2dissite homestead.test.conf
sudo a2dissite homestead.test-ssl.conf
sudo cp /home/vagrant/medieval-europe/config/homestead.test.conf /etc/apache2/sites-available/homestead.test.conf
sudo cp /home/vagrant/medieval-europe/config/homestead.test-ssl.conf /etc/apache2/sites-available/homestead.test-ssl.conf
sudo a2ensite homestead.test.conf
sudo a2ensite homestead.test-ssl.conf

sudo service php7.4-fpm stop
sudo apt install libapache2-mod-php7.4 libapache2-mod-php

sudo cp /home/vagrant/medieval-europe/config/php7.ini /etc/php/7.4/apache2/php.ini

sudo service apache2 restart

bash /home/vagrant/medieval-europe/config/init_me.sh