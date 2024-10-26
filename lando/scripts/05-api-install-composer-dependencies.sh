#!/bin/bash

COLOR='\033[0;33m' # Yellow
NC='\033[0m' # No Color

echo "\n${COLOR}Installing composer dependencies in api/${NC}\n"
cd /app/api
touch /tmp/composer-install-packages.log
echo "Y" | composer install >> /tmp/composer-install-packages.log 2>&1
