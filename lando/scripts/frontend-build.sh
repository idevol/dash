#!/bin/bash

CYAN='\033[0;36m'
NC='\033[0m' # No Color

echo "\n${CYAN}Build frontend/${NC}\n"
cd /app/web
npm run build