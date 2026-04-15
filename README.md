# Umvirt YAPS

## About

Umvirt YAPS (Yet Another Portal System) is autonomous portal system written on PHP.

PHP is allows to build big monolitic web-applications from scratch without any dependencies.

Umvirt lab maintainers are use YAPS with ULFS module as Web-interface to Umvirt Linux Packages service database.

## License

This software is licensed under GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007

## Features

- LAMP stack - classic Linux Apache MariaDB PHP stack is used
- Autonomy - no Internet connection is needed
- Localization - basic localization support with GNU Gettext
- Modules - code extension with additional modules
- Scripts - CLI-scripts can be used in addition to WEB-site
- HTML-forms generator - YAPS allows to automate HTML forms rendering
- RBAC - roles based access control

## Current development state

Currently YAPS is in early development stage.

Due to lack of resources development is not intensive than needed.

YAPS is not ready for public access but can be used on small LAN or localhost.

## Installation

- deploy LAMP stack site
- place YAPS on site root directory
- deploy database from SQL-dump in 'sql/database.sql' file
- create config file 'inc/config.php' and edit it
- generate .htaccess file with 'bin/update_htaccess' script
- open site in browser
