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
		echo "Error : php.ini not found."
		exit 1
	else
		echo "php.ini found : $ini_file"
	fi

	if [[ "$OSTYPE" == "darwin"* ]]; then
        	# macOS
		echo "macOS detected";
		sed -i '' -e 's/upload_max_filesize\s*=.*/upload_max_filesize=20M/g' "$ini_file"
		sed -i '' -e 's/post_max_size\s*=.*/post_max_size=21M/g' "$ini_file"


		if [ $? -ne 0 ]; then
			echo "Error : sed failed (mac)"
			exit 1
		fi
    	else
		#GNU Linux        	
		sed -i 's/upload_max_filesize\s*=.*/upload_max_filesize=20M/g' "$ini_file"
		sed -i 's/post_max_size\s*=.*/post_max_size=21M/g' "$ini_file"
		
		if [ $? -ne 0 ]; then
			echo "Error : sed failed"
			exit 1
		fi
	fi

	echo "upload_max_filesize (20M) and post_max_size updated (21M) in $ini_file."
}

php_ini_path=$(php -i | grep -E 'Loaded Configuration File' | awk '{print $NF}')

update_php_ini "$php_ini_path"
