FROM php:7.4.2-apache
RUN apt-get update && \
    apt-get install -y
RUN apt-get install -y curl
RUN apt-get install -y build-essential libssl-dev zlib1g-dev libpng-dev libjpeg-dev libfreetype6-dev
RUN apt-get install -y libicu-dev libzip-dev libonig-dev
WORKDIR /var/www/html
COPY sites-available/ci4.conf /etc/apache2/sites-enabled/ci4.conf
RUN docker-php-ext-install gd intl mysqli pdo pdo_mysql zip mbstring
RUN apt-get update
RUN docker-php-ext-install intl
RUN docker-php-ext-configure intl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd
RUN a2enmod rewrite
RUN service apache2 restart
