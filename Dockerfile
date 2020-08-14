FROM ubuntu:18.04
RUN apt update && apt -y upgrade
RUN apt install -y software-properties-common
RUN apt update
RUN ln -fs /usr/share/zoneinfo/America/New_York /etc/localtime
RUN export DEBIAN_FRONTEND=noninteractive
RUN apt install -y tzdata
RUN dpkg-reconfigure --frontend noninteractive tzdata
RUN apt install -y \
    apache2 \
    php \
    php-mysql \
    php-memcache \
    php-gd \
    php-xml \
    phpmd \
    composer \
    mysql-server \
    unzip

COPY . /var/www/medieval-europe

COPY config/php7.ini /etc/php/7.2/apache2/
COPY config/medieval-europe.conf /etc/apache2/sites-available/

RUN a2dissite 000-default
RUN a2ensite medieval-europe.conf
RUN chmod a+w /var/www/medieval-europe/public_html/upload
RUN chmod a+w /var/www/medieval-europe/public_html/media/images/characters
RUN mkdir /var/www/medieval-europe/public_html/application/logs
RUN chmod a+w /var/www/medieval-europe/public_html/application/logs

CMD /var/www/medieval-europe/scripts/init_and_run.sh
