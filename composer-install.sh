#!/bin/bash
# Download Composer 2 if not present
if [ ! -f composer2.phar ]; then
    php -r "copy('https://getcomposer.org/composer-stable.phar', 'composer2.phar');"
fi
export COMPOSER_MEMORY_LIMIT=-1
php composer2.phar install "$@"
