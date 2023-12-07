#!/bin/sh
#
# This script update the php.ini
#
# Custom 3D model support requires increasing the maximum file upload size.
#
# This script change the values of :
# - upload_max_filesize: 20M
# - post_max_size: 21M

update_php_ini() {
    local ini_file="$1"
    
    if [ ! -f "$ini_file" ]; then
        echo "Erreur : Le fichier php.ini n'existe pas."
        exit 1
    fi

    sed -i 's/upload_max_filesize\s*=.*/upload_max_filesize=20M/g' "$ini_file"
    sed -i 's/post_max_size\s*=.*/post_max_size=21M/g' "$ini_file"

    echo "upload_max_filesize and post_max_size updated in $ini_file."
}

php_ini_path=$(php -i | grep -E 'Loaded Configuration File' | awk '{print $NF}')

update_php_ini "$php_ini_path"
