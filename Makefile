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
	cp --no-clobber plugins-available/top/config-sample.ini plugins-available/top/config.ini
	mkdir --parents plugins-enabled
	cd plugins-enabled && if [ ! -L top ]; then ln -s ../plugins-available/top; fi

test:
	./vendor/bin/phpunit tests
