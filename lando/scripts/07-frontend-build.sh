#!/bin/bash

COLOR='\033[0;33m' # Yellow
NC='\033[0m' # No Color

echo "${COLOR}Build frontend${NC}"

cd /app/web
npm run build

echo "\n"
