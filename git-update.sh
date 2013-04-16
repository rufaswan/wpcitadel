#!/bin/bash

[ $# = 0 ] && { echo "please type a comment"; exit; }

git add *
git remote rm origin
git remote add origin git@github.com:rufaswan/wpcitadel.git
git commit -m "$@"
git push origin master
