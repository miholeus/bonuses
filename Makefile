composer_bin = /usr/local/bin/composer
phpunit_bin = /usr/local/bin/phpunit

composer:
	curl -L http://getcomposer.org/composer.phar -o composer && chmod +x composer && mv composer $(composer_bin)

install: composer
	composer install --dev --no-interaction

phpunit:
	curl -L https://phar.phpunit.de/phpunit-7.phar -o phpunit && chmod +x phpunit && mv phpunit $(phpunit_bin)

test: install phpunit
	phpunit -c .

default_target: test
.PHONY: test composer install phpunit