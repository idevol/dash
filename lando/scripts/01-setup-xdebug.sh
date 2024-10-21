#!/bin/bash

COLOR='\033[0;33m' # Yellow
NC='\033[0m' # No Color

echo "\n${COLOR}Setup Xdebug${NC}\n"
touch /tmp/xdebug.log
chown www-data:www-data /tmp/xdebug.log
