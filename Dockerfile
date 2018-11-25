FROM ubuntu:latest

# Install apache, PHP, and supplimentary programs.
RUN apt-get update -y && apt-get -y upgrade && DEBIAN_FRONTEND=noninteractive
RUN apt-get install software-properties-common -y
RUN LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php && apt-get update -y
RUN DEBIAN_FRONTEND=noninteractive  apt-get -y install \
    apache2 php7.1 libapache2-mod-php7.1 curl php-gd php-json git php-xdebug

RUN curl -sS https://getcomposer.org/installer | php \
    && chmod +x composer.phar && mv composer.phar /usr/local/bin/composer

# Enable apache mods.
RUN a2enmod php7.1
RUN a2enmod rewrite
RUN a2enmod headers

# ----------------------------
# Configure a xDebug Extension
# ----------------------------

RUN echo "zend_extension=/usr/lib/php/20160303/xdebug.so" >> /etc/php/7.1/apache2/php.ini
RUN echo "xdebug.max_nesting_level=250" >> /etc/php/7.1/apache2/php.ini
RUN echo "xdebug.var_display_max_depth=10" >> /etc/php/7.1/apache2/php.ini
RUN echo "xdebug.remote_enable=true" >> /etc/php/7.1/apache2/php.ini
RUN echo "xdebug.remote_handler=dbgp" >> /etc/php/7.1/apache2/php.ini
RUN echo "xdebug.remote_mode=req" >> /etc/php/7.1/apache2/php.ini
#RUN echo "xdebug.remote_port=9000" >> /etc/php/7.1/apache2/php.ini
RUN echo "xdebug.remote_host=host.docker.internal" >> /etc/php/7.1/apache2/php.ini #Please provide your host (local machine IP)
RUN echo "xdebug.idekey=phpstorm-xdebug" >> /etc/php/7.1/apache2/php.ini
RUN echo "xdebug.remote_autostart=1" >> /etc/php/7.1/apache2/php.ini
RUN echo "xdebug.remote_log=/var/log/apache2/xdebug_remote.log" >> /etc/php/7.1/apache2/php.ini

# Manually set up the apache environment variables
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid

# Environement
ENV IS_PROD 0

# Expose apache.
EXPOSE 80

# Copy this repo into place.
ADD lib /var/www/lib

RUN chown -R www-data:www-data /var/www/lib

VOLUME ["/var","/var/www/lib"]

# Update the default apache site with the config we created.
ADD ./docker/apache/apache-config_local.conf /etc/apache2/sites-enabled/000-default.conf

WORKDIR /var/www/lib
RUN composer install --no-interaction

# By default start up apache in the foreground, override with /bin/bash for interative.
CMD /usr/sbin/apache2ctl -D FOREGROUND
