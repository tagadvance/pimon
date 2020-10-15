default:
	echo "Nothing to do"

install: configure
	composer install

update:
	git pull
	composer update

configure:
	cp --no-clobber config-sample.ini config.ini

test:
	./vendor/bin/phpunit tests
