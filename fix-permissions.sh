#!/bin/bash

#delete the file before change permissions
rm var/log/webapp-text-logger

setfacl -R -m u:www-data:rwx var/log var/cache
setfacl -R -d -m u:www-data:rwx var/log var/cache

setfacl -R -m u:`whoami`:rwx var/log var/cache
setfacl -R -d -m u:`whoami`:rwx var/log var/cache

setfacl -R -m mask:rwx var/log var/cache
setfacl -R -d -m mask:rwx var/log var/cache

#create the file with the right permissions
touch var/log/webapp-text-logger