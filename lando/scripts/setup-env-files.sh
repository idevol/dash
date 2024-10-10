#!/bin/bash

CYAN='\033[0;36m'
GREEN='\033[0;32m'
NC='\033[0m' # No Color
echo "\n${CYAN}Setup .env files on web/ and api/${NC}\n"

LANDO_URL=`php /app/lando/scripts/get-lando-url.php`
echo "\nLANDO URL:\n${GREEN}${LANDO_URL}${NC}\n"

cd /app/api
if [ ! -f /app/api/.env ]; then
    cp /app/api/.env.localhost /app/api/.env
fi
API_ENV_FILE=`while read -r line; do if echo "$line" | grep -q DASH_API_HOST; then echo "DASH_API_HOST=${LANDO_URL}"; else echo "$line"; fi; done < .env`
echo "${API_ENV_FILE}" > /app/api/.env

cd /app/web
if [ ! -f /app/web/.env ]; then
    cp /app/web/.env.localhost /app/web/.env
fi
LANDING_PAGE_ENV_FILE=`while read -r line; do if echo "$line" | grep -q DASH_API_HOST; then echo "DASH_API_HOST=${LANDO_URL}"; else echo "$line"; fi; done < .env`
echo "${LANDING_PAGE_ENV_FILE}" > /app/web/.env
