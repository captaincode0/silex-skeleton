#!/bin/bash

cd ..
mv silex-skeleton silexskeleton.herokuapp.com
cd silexskeleton.herokuapp.com
./fix-permissions.sh
composer install
sudo cp vhosts.conf /etc/apache2/sites-available/silexskeleton.herokuapp.com.conf
sudo a2ensite silexskeleton.herokuapp.com
sudo service apache2 reload
sudo sh -c 'echo "127.0.0.1 	silexskeleton.herokuapp.com" >> /etc/hosts'
sudo service networking restart
sudo ping -c 4 silexskeleton.herokuapp.com
firefox --new-window silexskeleton.herokuapp.com