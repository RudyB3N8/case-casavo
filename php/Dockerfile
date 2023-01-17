FROM php:fpm-alpine

######## Dependencies ########
RUN apk add --no-cache --update \
    git \
    zip \
    unzip \
    bzip2-dev \
    enchant2-dev \
    libpng-dev \
    gmp-dev \
    imap-dev \
    icu-dev \
    openldap-dev \
    freetds-dev \
    postgresql-dev \
    aspell-dev \
    net-snmp-dev \
    libxml2-dev \
    tidyhtml-dev  \
    libxslt-dev \
    libzip-dev

RUN docker-php-ext-install \
  bcmath \
  bz2 \
  calendar \
  dba \
  enchant \
  exif \
  ffi \
  gd \
  gettext \
  gmp \
  imap \
  intl \
  ldap \
  mysqli \
  opcache \
  pcntl \
  pdo_dblib \
  pdo_mysql \
  pdo_pgsql \
  pgsql \
  pspell \
  shmop \
  snmp \
  soap \
  sockets \
  sysvmsg \
  sysvsem \
  sysvshm \
  tidy \
  xsl \
  zend_test \
  zip

RUN docker-php-ext-enable opcache

########## Composer ##########
RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/local/bin --filename=composer

######## Symfony CLI #########
RUN apk add --no-cache bash \
    && curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash \
    && apk add symfony-cli

RUN rm -rf /tmp/* /var/cache/apk/*