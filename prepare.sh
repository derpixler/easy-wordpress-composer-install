#!/bin/bash

# set colors
RED='\033[0;31m'
GREEN='\033[3;32;40m'
YELLOW='\033[1;33;40m'
NC='\033[0m' # No Color

public_folder='public'

cp wp-config.php.dist html/wp-config.php
printf "  - Copy ${GREEN}wp-config.php.dist${NC} -> ${GREEN}html/wp-config.php${NC}\n    Files copied\n\n"

cp .htaccess.dist ${public_folder}/.htaccess
printf "  - Copy ${GREEN}.htaccess.dist${NC} -> ${GREEN}${public_folder}/.htaccess.php${NC}\n    Files copied\n\n"
