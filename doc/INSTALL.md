## Database installation

- create database user
- create database 
- restore core database structure

cat database.sql | mysql portal -u portal -psecret

- check database

## Site installation

- deploy yaps in specific directory

git clone https://gitlab.com/Umvirt/yaps portal

- create config.php from template
cd inc
cp config.php.sample config.php
- edit inc/config.php

- create directory inc/modules.
mkdir inc/modules
- create directory inc/controllers/common 
mkdir inc/controllers/common

- update .htaccess

cd bin
update_htaccess

- check site access

## Super user creation

- Compose a password
- Pass a password to bin/password script to get encrypted password.
- Create record in database table user with values recieved earlier.
- check user access
