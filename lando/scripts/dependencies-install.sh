#!/bin/bash

CYAN='\033[0;36m'
NC='\033[0m' # No Color

echo "\n${CYAN}Installing backend dependencies in api/${NC}\n"
cd /app/api
echo "Y" | composer install

echo "\n${CYAN}Installing frontend dependencies in web/${NC}\n"
cd /app/web
npm update -g npm
npm install --silent
