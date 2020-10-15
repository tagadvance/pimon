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
Plugins must have a filename matching '*Plugin.php' and implement `\tagadvance\pimon\Plugin`.

Plugins should return a new instance of the plugin at the end of the class definition.

I haven't figured out how to best handle dependencies in plugins. For me it isn't an issue.
