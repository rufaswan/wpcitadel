#!/bin/bash

# for internal use, relink the theme files to localhost directory
function wptheme()
{
	for i in "$@"; do
		http="$HOME/Web-Server/$i/wp-content/themes/"
		rm -vfr "$http"wpcitadel2
		ln -s $(readlink -f ./wpcitadel2) "$http"

		cd wpcitadel2-child
		for j in *; do
			rm -vfr "$http""$j"
			ln -s $(readlink -f "$j") "$http"
		done
		cd ..
	done
}
wptheme wp34 wp35

# for internal use, to open all PHP fles (under project) on geany text editor
pid=$(pidof geany)
[[ "$pid" == '' ]] && { xterm --hold -e echo "Please start a copy of Geany first"; exit; }
find . -type f -iname "*.php" -exec geany {} \;
