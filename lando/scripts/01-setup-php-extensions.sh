#!/bin/bash

COLOR='\033[0;33m' # Yellow
NC='\033[0m' # No Color

echo "\n${COLOR}Setup Xdebug${NC}\n"
touch /tmp/xdebug.log
chown www-data:www-data /tmp/xdebug.log

echo "${COLOR}Installing PHP YAML extension${NC}\n"
touch /tmp/yaml-install.log
apt-get update -y >> /tmp/yaml-install.log 2>&1
apt install libyaml-dev -y >> /tmp/yaml-install.log 2>&1
printf "\n" | pecl install yaml >> /tmp/yaml-install.log 2>&1
touch /usr/local/etc/php/conf.d/zzy-lando-yaml.ini
echo "extension=yaml.so" >> /usr/local/etc/php/conf.d/zzy-lando-yaml.ini
