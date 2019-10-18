FROM ubuntu:18.04
COPY . /var/www/medieval-europe
RUN apt update && apt -y upgrade
RUN apt install -y software-properties-common
RUN LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php
RUN apt update
RUN ln -fs /usr/share/zoneinfo/America/New_York /etc/localtime
RUN export DEBIAN_FRONTEND=noninteractive
RUN apt install -y tzdata
RUN dpkg-reconfigure --frontend noninteractive tzdata
RUN apt install -y \
    apache2 \
    php5.6 \
    php5.6-mysql \
    php5.6-memcache \
    php5.6-gd \
    php5.6-xml \
    phpmd \
    composer \
    memcached \
    mysql-server \
    unzip

COPY config/php.ini /etc/php/5.6/apache2/
COPY config/medieval-europe.conf /etc/apache2/sites-available/

RUN a2dissite 000-default
RUN a2ensite medieval-europe.conf
RUN a2enmod php5.6
RUN chmod a+w /var/www/medieval-europe/public_html/upload
RUN chmod a+w /var/www/medieval-europe/public_html/media/images/characters
RUN mkdir /var/www/medieval-europe/public_html/application/logs
RUN chmod a+w /var/www/medieval-europe/public_html/application/logs

CMD /var/www/medieval-europe/scripts/init_and_run.sh
