#!/bin/bash

YELLOW='\033[0;33m'
GREEN='\033[0;32m'
NC='\033[0m' # No Color

echo "\n${YELLOW}Setup LANDO_URL on .env files of api/ and web/ directories${NC}\n"

API_ENV_FILE=/app/api/.env
WEB_ENV_FILE=/app/web/.env

LANDO_URL=`php /app/lando/scripts/get-lando-url.php`
DASH_HOST_ENV="DASH_HOST=${LANDO_URL}";
VITE_DASH_HOST_ENV="VITE_DASH_HOST=${LANDO_URL}";
echo "🚀 LANDO LOCAL URL: ${GREEN}${LANDO_URL}${NC}\n"

if test -f "${API_ENV_FILE}"; then
  cd /app/api
  if grep -q "${DASH_HOST_ENV}" "${API_ENV_FILE}"; then
    echo "✅ Declared \"${DASH_HOST_ENV}\" in \"api/.env\" file."
  else
    if grep -q "DASH_HOST" "${API_ENV_FILE}"; then
      API_ENV_FILE_CONTENT=`while read -r line; do if echo "$line" | grep -q DASH_HOST; then echo "${DASH_HOST_ENV}"; else echo "$line"; fi; done < .env`
      echo "${API_ENV_FILE_CONTENT}" > "${API_ENV_FILE}"
    else
      echo "\n${DASH_HOST_ENV}" >> "${API_ENV_FILE}"
    fi
    echo "✅ Setup \"${DASH_HOST_ENV}\" in \"api/.env\" file."
  fi
else
  echo '❌ File "api/.env" not found.'
fi

if test -f "${WEB_ENV_FILE}"; then
  cd /app/web
  if grep -q "${VITE_DASH_HOST_ENV}" "${WEB_ENV_FILE}"; then
    echo "✅ Declared \"${VITE_DASH_HOST_ENV}\" in \"web/.env\" file."
  else
    if grep -q "VITE_DASH_HOST" "${WEB_ENV_FILE}"; then
      WEB_ENV_FILE_CONTENT=`while read -r line; do if echo "$line" | grep -q DASH_HOST; then echo "${VITE_DASH_HOST_ENV}"; else echo "$line"; fi; done < .env`
      echo "${WEB_ENV_FILE_CONTENT}" > "${WEB_ENV_FILE}"
    else
      echo "\n${VITE_DASH_HOST_ENV}" >> "${WEB_ENV_FILE}"
    fi
    echo "✅ Setup \"${VITE_DASH_HOST_ENV}\" in \"web/.env\" file."
  fi
else
  echo '❌ File "web/.env" not found.'
fi