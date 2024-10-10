#!/bin/bash

CYAN='\033[0;36m'
NC='\033[0m' # No Color

echo "\n${CYAN}Xdebug setup${NC}\n"
touch /tmp/xdebug.log
chown www-data:www-data /tmp/xdebug.log