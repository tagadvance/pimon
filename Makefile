default:
	echo "Nothing to do"

install: configure
	apt install --assume-yes composer php-bcmath php-cli php-curl php-json php-mysql php-sqlite3 php-xml
	composer install

update:
	git pull
	composer update

configure:
	cp --no-clobber config-sample.ini config.ini

test:
	./vendor/bin/phpunit tests
