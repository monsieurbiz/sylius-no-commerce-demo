FROM monsieurbiz/php:8.0-fpm

RUN pecl install redis && \
    docker-php-ext-enable redis

# Install wkhtmltopdf
RUN apt-get update && \
    apt-get install -y \
        fontconfig \
        fontconfig-config \
        fonts-dejavu-core \
        libfontconfig1 \
        libfontenc1 \
        libxrender1 \
        ucf \
        x11-common \
        xfonts-75dpi \
        xfonts-base \
        xfonts-encodings \
        xfonts-utils && \
    wget https://github.com/wkhtmltopdf/wkhtmltopdf/releases/download/0.12.5/wkhtmltox_0.12.5-1.stretch_amd64.deb && \
    dpkg -i wkhtmltox_0.12.5-1.stretch_amd64.deb && \
    rm wkhtmltox_0.12.5-1.stretch_amd64.deb

# Install APCu
RUN pecl install apcu
RUN echo "extension=apcu.so" > ${PHP_INI_DIR}/conf.d/apcu.ini

COPY files/vhost.conf /etc/nginx/sites-enabled/vhost.conf

# Symfony binary
COPY files/bin/console /usr/local/bin/console
RUN chmod a+x /usr/local/bin/console

# Use compsoer v2
RUN composer self-update --2

# Config
RUN echo "memory_limit=-1" >> ${PHP_INI_DIR}/conf.d/memory.ini

# Crontab
COPY files/crontab /etc/cron.d/sylius-no-commerce

# Use www-data user
ARG USER_UID=1000
RUN usermod -u $USER_UID www-data
