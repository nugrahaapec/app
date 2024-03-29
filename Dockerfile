FROM php:8.1.19-apache

RUN apt-get update
RUN apt-get upgrade -y

RUN apt-get install --fix-missing -y libpq-dev
RUN apt-get install --no-install-recommends -y libpq-dev
RUN apt-get install -y libxml2-dev libbz2-dev zlib1g-dev
RUN apt-get -y install libsqlite3-dev libsqlite3-0 mariadb-client curl exif ftp
RUN docker-php-ext-install intl
RUN docker-php-ext-install mysqli
RUN apt-get -y install --fix-missing zip unzip

# Composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer
RUN composer self-update

ADD conf/apache.conf /etc/apache2/sites-available/000-default.conf

#RUN cd /var/www/html
#RUN composer create-project codeigniter4/appstarter codeigniter4 -s rc
#COPY . /var/www/html
#RUN ls
#RUN chmod -R 777 /var/www/html/writable

RUN apt-get clean \
    && rm -r /var/lib/apt/lists/*
    
VOLUME /var/www/html