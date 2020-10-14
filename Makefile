default:
	echo "Nothing to do"

install:
	apt install --assume-yes composer php-cli php-curl php-json php-mysql php-sqlite3 php-xml
	composer install

update:
	git pull
	composer update

test:
	./vendor/bin/phpunit tests
