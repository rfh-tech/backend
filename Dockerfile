FROM thecodingmachine/php:7.4-v4-fpm
USER root
RUN apt-get update -yq && apt-get install -yq git curl g++ make mysql-server zip unzip php-zip php7.4-dev php-pear && rm -rf /var/lib/apt/lists/*
ADD . /var/www/html/backend
COPY apache_confs/vhost.conf /etc/apache2/sites-enabled/000-default.conf
COPY apache_confs/apache2.conf /etc/apache2/apache2.conf
COPY apache_confs/ports.conf /etc/apache2/ports.conf
RUN chown -R www-data:www-data /var/www/html && chmod -R g+rw /var/www/html
RUN phpenmod -v 7.4 curl simplexml
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN wget http://archive.ubuntu.com/ubuntu/pool/main/g/glibc/multiarch-support_2.27-3ubuntu1.4_amd64.deb
RUN apt-get install ./multiarch-support_2.27-3ubuntu1.4_amd64.deb

EXPOSE 80