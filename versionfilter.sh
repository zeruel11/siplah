#!/bin/sh

#test='application\models\Beranda_model.php'
name=`echo $1 | tr '\\\' '/'`
# rev=`git log --follow --name-only --format='%H' -- $name | wc`
rev=`git rev-list HEAD --count -- $name`
echo "File revision: "$rev
