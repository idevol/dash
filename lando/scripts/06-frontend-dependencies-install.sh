#!/bin/bash

COLOR='\033[0;33m' # Yellow
NC='\033[0m' # No Color

echo "${COLOR}Installing node dependencies in web/${NC}\n"
cd /app/web
npm install --silent
