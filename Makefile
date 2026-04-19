start:
	php -S 0.0.0.0:8000 -t public

install:
	composer install

lint:
	./vendor/bin/phpcs --standard=PSR12 src

lint-fix:
	./vendor/bin/phpcbf --standard=PSR12 src
