#!/bin/bash

mkdir var
mkdir var/log
mkdir var/cache

sudo setfacl -R -m u:www-data:rwx var/log var/cache
sudo setfacl -R -d -m u:www-data:rwx var/log var/cache

sudo setfacl -R -m u:`whoami`:rwx var/log var/cache
sudo setfacl -R -d -m u:`whoami`:rwx var/log var/cache

sudo setfacl -R -m mask:rwx var/log var/cache
sudo setfacl -R -d -m mask:rwx var/log var/cache

touch var/log/webapp-text-logger
