#!/bin/bash

COLOR='\033[0;33m' # Yellow
NC='\033[0m' # No Color

echo "\n${COLOR}Build frontend/${NC}\n"
cd /app/web
npm run build
