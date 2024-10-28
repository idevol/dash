#!/bin/bash

YELLOW='\033[0;33m'
GREEN='\033[0;32m'
NC='\033[0m' # No Color

LANDO_URL=`php /app/lando/scripts/get-lando-url.php`

echo "${YELLOW}Local URL's idEvol Dashboard${NC}\n"
echo "\t- ${GREEN}${LANDO_URL}/${NC}"
echo "\t- ${GREEN}${LANDO_URL}/dash${NC}"
echo "\t- ${GREEN}${LANDO_URL}/api/users${NC}"
echo "\t- ${GREEN}${LANDO_URL}/api/panel/${NC}"
echo "\n"