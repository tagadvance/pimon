# PiMon
A lightweight monitoring solution for Rasberry Pis running Ubuntu

## Installation
```
mkdir ~/git
cd ~/git
git clone git@github.com:tagadvance/pimon.git
cd pimon
sudo make install
make test
make init

./pimon.php --dry-run
```

## Scheduling
```
echo "* * * * * root ${HOME}/pimon/pimon.php" > /etc/cron.d/pimon
```

## Update
```
make update
```

## Plugins
Plugins must have a filename matching '*Plugin.php' and implement `\tagadvance\pimon\Plugin`. Schedule can be overridden on a per-plugin basis.

Plugins may have their own `composer.json`. I leave it to you to ensure that there are no dependency conflicts.

Plugins should return a new instance of the plugin at the end of the class definition.
