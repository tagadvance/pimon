# PiMon
A lightweight monitoring solution for Rasberry Pis running Ubuntu

## Installation
```
sudo apt install --assume-yes composer make php-bcmath php-cli php-curl php-json php-mysql php-sqlite3 php-xml

mkdir ~/git
cd ~/git
git clone https://github.com/tagadvance/pimon.git
cd pimon
make install
make test

./pimon.php --dry-run
```

## Scheduling
`crontab -e`
Add the following to the bottom and ensure there is a blank line at the bottom.
`* * * * * /home/ubuntu/git/pimon/pimon.php`

## Update
```
make update
```

## Plugins
Plugins must have a filename matching '*Plugin.php' and implement `\tagadvance\pimon\Plugin`.

Plugins should return a new instance of the plugin at the end of the class definition.

I haven't figured out how to best handle dependencies in plugins. For me it isn't an issue.
