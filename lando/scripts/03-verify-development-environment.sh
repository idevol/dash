#!/bin/bash

COLOR='\033[0;33m' # Yellow
NC='\033[0m' # No Color

API_ENV_FILE="/app/api/.env"
DB_SQLITE_FILE="/app/api/src/Db/database.sqlite"
DB_MANAGER_FILE="/app/api/src/Application/Factory/DatabaseManagerFactory.php"

random_string(){
  tr -dc A-Za-z0-9",+|<>@_" </dev/urandom | head -c 32; echo
}

create_api_env(){
  if [ ! -f $API_ENV_FILE ]; then
    local RANDOM1=`random_string`
    local RANDOM2=`random_string`
    touch $API_ENV_FILE
    echo "DASH_SALT=$RANDOM1" >> $API_ENV_FILE
    echo "DASH_INIT_VECTOR=$RANDOM2" >> $API_ENV_FILE
    echo '✅ File "api/.env" was created.'
  fi
}

needs_api_env_explaining(){
  echo 'To run the application in any environment you need to create the file "api/.env"'
  echo 'https://github.com/idevol/dash?tab=readme-ov-file#definici%C3%B3n-de-variables-de-entorno'
}

is_default_db_config(){
  local IS_DEFAULT_DB_CONFIG=false
  if [ -f $DB_MANAGER_FILE ]; then
    local IS_DB_DRIVER_SQLITE=false
    local IS_DB_SQLITE_FILE=false
    while read -r line; do
      if echo "$line" | grep -q "'driver'"; then
        if echo "$line" | grep -q "=> 'sqlite',"; then 
          local IS_DB_DRIVER_SQLITE=true
        fi
      fi

      if echo "$line" | grep -q "'database'"; then
        if echo "$line" | grep -q "=> __DIR__ . '/../../Db/database.sqlite'"; then 
          local IS_DB_SQLITE_FILE=true
        fi
      fi
    done < $DB_MANAGER_FILE

    if [ "$IS_DB_DRIVER_SQLITE" = true ] && [ "$IS_DB_SQLITE_FILE" = true ]; then
      local IS_DEFAULT_DB_CONFIG=true
    fi
  fi
  echo $IS_DEFAULT_DB_CONFIG
}

needs_db(){
  echo 'To run the application in any environment you need to create and connect a database.'
  echo 'https://github.com/idevol/dash/blob/main/docs/database.md'
}

echo "\n${COLOR}Verifying development environment requirements${NC}\n"

if [ -f $API_ENV_FILE ]; then
  echo '✅ File "api/.env" found.'
else
  echo '❌ File "api/.env" not found.'
  while true; do
      read -p 'Do you want to generate the ".env" file inside "api/" directory? [ yes | no ] : ' yn
      case $yn in
          [YySs]* ) create_api_env; break;;
          [Nn]* ) needs_api_env_explaining; break;;
          * ) echo "Please answer: yes or no.";;
      esac
  done
fi

IS_DEFAULT_DB_CONFIG=`is_default_db_config`
if [ "$IS_DEFAULT_DB_CONFIG" = true ]; then
  if [ -f $DB_SQLITE_FILE ]; then
    echo '✅ Database at "api/src/Db/database.sqlite" found.'
  else
    echo '\n❌ Database at "api/src/Db/database.sqlite" not found.'
    needs_db
  fi
fi
