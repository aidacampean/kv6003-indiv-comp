FROM php:fpm-alpine
 
ARG WORK_DIR=/var/www
# Copy composer.lock and composer.json
#COPY composer.lock composer.json /var/www/
 
# Set working directory
WORKDIR ${WORK_DIR}
 
# Install dependencies
RUN apk update && apk add --no-cache php8 \
    php8-common \
    php8-pdo \
    php8-opcache \
    php8-zip \
    php8-phar \
    php8-iconv \
    php8-cli \
    php8-curl \
    php8-openssl \
    php8-mbstring \
    php8-tokenizer \
    php8-fileinfo \
    php8-json \
    php8-xml \
    php8-xmlwriter \
    php8-simplexml \
    php8-dom \
    php8-pdo_mysql \
    # php8-pdo_sqlite \
    php8-tokenizer \
    # php8-pecl-redis \
    curl \
    bash \
    zip \
    unzip \
    nodejs \
    npm
 
# Clear cache
# RUN apt-get clean && rm -rf /var/lib/apt/lists/*
 
# Install extensions
#RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
#RUN docker-php-ext-install mysqli pdo pdo_mysql
#RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN docker-php-ext-install mysqli pdo pdo_mysql
 
# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
 
# Add user for laravel application
RUN addgroup -g 1000 www
#RUN adduser -D -H -u 1000 -s /bin/bash www -g www

# www user
RUN adduser \
    --disabled-password \
    --gecos "" \
    --home "$(pwd)" \
    --ingroup "www" \
    --no-create-home \
    --uid "1000" \
    "www"
 
# RUN addgroup -g 1000 www
# RUN adduser -D -H -u 1000 -s /bin/bash developer -G www
 
# Copy existing application directory contents
COPY . ${WORK_DIR}
 
# Copy existing application directory permissions
COPY --chown=www:www . ${WORK_DIR}
 
# Change current user to www
USER www
 
# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
