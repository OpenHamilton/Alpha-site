#!/bin/sh
export PHPRC=/
export PHP_FCGI_CHILDREN=2
exec /dh/cgi-system/php5.cgi $*