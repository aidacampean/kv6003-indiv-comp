FROM php:fpm-alpine
 
ARG WORK_DIR=/var/www
# Copy composer.lock and composer.json
#COPY composer.lock composer.json /var/www/
 
# Set working directory
WORKDIR ${WORK_DIR}
 
# Install dependencies
RUN apk update && apk add --no-cache php8 $PHPIZE_DEPS \
    php8-common \
    php8-pdo \
    curl \
    bash \
    zip \
    unzip \
    nodejs \
    npm \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

# Clear cache
# RUN apt-get clean && rm -rf /var/lib/apt/lists/*
 
# Install extensions
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
