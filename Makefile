install:
	composer install

lint:
	./vendor/bin/phpcs --standard=PSR12 src

lint-fix:
	./vendor/bin/phpcbf --standard=PSR12 src
