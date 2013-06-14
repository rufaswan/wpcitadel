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

# recreate packaged zip files
rm -vf *.zip
zip -r wpcitadel2.zip wpcitadel2

cd wpcitadel2-child
for j in *; do
	zip -r ../"$j".zip "$j"
	cd ..
	zip -r "$j".zip wpcitadel2
	cd wpcitadel2-child
done
cd ..

# starting git
[ $# = 0 ] && { echo "please type a comment within quotes"; exit; }

git add *
git rm $(git ls-files --deleted)
git remote rm origin
git remote add origin git@github.com:rufaswan/wpcitadel.git
git commit -m "$1"
git push origin master
