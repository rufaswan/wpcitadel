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

[ $# = 0 ] && { echo "please type a comment within quotes"; exit; }

rm -vf *.zip
zip -r wpcitadel2.zip wpcitadel2
zip -r wpcitadel2-child.zip wpcitadel2-child
git add *
git rm $(git ls-files --deleted)
git remote rm origin
git remote add origin git@github.com:rufaswan/wpcitadel.git
git commit -m "$1"
git push origin master
