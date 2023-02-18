APP_ENV=prod
APP_DEBUG=0
composer dump-env prod
#php bin/console dotenv:dump
composer install --no-dev --optimize-autoloader
php bin/console cache:clear
