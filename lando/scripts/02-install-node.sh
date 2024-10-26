#!/bin/bash

COLOR='\033[0;33m' # Yellow
NC='\033[0m' # No Color

echo "${COLOR}Installing Node.js${NC}\n"

touch /tmp/node-install.log

# Note that you will want to use the script for the major version of node you want to install
# See: https://github.com/nodesource/distributions/blob/master/README.md#installation-instructions

curl -fsSL https://deb.nodesource.com/setup_20.x | bash -  >> /tmp/node-install.log 2>&1
apt-get install -y nodejs >> /tmp/node-install.log 2>&1

npm update -g npm >> /tmp/node-install.log 2>&1
