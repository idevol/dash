#!/bin/bash

COLOR='\033[0;33m' # Yellow
NC='\033[0m' # No Color

echo "\n${COLOR}Installing Node.js${NC}\n"

# Note that you will want to use the script for the major version of node you want to install
# See: https://github.com/nodesource/distributions/blob/master/README.md#installation-instructions

curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
apt-get install -y nodejs

npm update -g npm
