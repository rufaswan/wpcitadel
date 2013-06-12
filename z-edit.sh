#!/bin/bash

function wptheme()
{
	for i in "$@"; do
		http="$HOME/Web-Server/$i/wp-content/themes/"
		rm -vfr "$http"wpcitadel2
		ln -s $(readlink -f ./wpcitadel2) "$http"
		ln -s $(readlink -f ./wpcitadel2-child) "$http"
	done
}
wptheme wp34 wp35

pid=$(pidof geany)
[[ "$pid" == '' ]] && { xterm --hold -e echo "Please start a copy of Geany first"; exit; }
find . -type f -iname "*.php" -exec geany {} \;
