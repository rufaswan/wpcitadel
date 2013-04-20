#!/bin/bash

[ $# = 0 ] && { echo "please type a comment within quotes"; exit; }

git add *
git remote rm origin
git remote add origin git@github.com:rufaswan/wpcitadel.git
git commit -m "$1"
git push origin master
