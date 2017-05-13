#!/bin/bash

# Prepare Vagrantfile strip the hosts the Vagrant name and ip
# out of the composer.json and write the ip and name into the
# Vagrantfile. The host will written in to config/hosts.list
#
# Set symlinks from vendor/wp-content
# to vagrant/html/${host[1]}/${host[1]}/ for wp-content

# set colors
RED='\033[0;31m'
GREEN='\033[3;32;40m'
YELLOW='\033[1;33;40m'
NC='\033[0m' # No Color

cp wp-config.php.dist html/wp-config.php
printf "  - Copy ${GREEN}wp-config.php.dist${NC} -> ${GREEN}vagrant/html/wp-config.php${NC}\n    Files copied\n\n"


