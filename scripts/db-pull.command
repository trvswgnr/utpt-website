#!/bin/bash
DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" >/dev/null 2>&1 && pwd)"; cd $DIR
##
# wp-db-pull
# Export the database from remote server and overwrite local
# NOTES: - This script may contain sensitive information. If adding this file to a repo,
#          it is recommended to add sensitive variables to a file named ".env". The variables below are for reference.
#        - This file needs executable permissions (run "chmod u+x ./wp-db-pull.command")
#        - Requires SSH access
####

# environment name
ENV_NAME="envname"

# the local db name, found in wp-config.php
LOCAL_DB="db-name"

# the WP installation folder in your 'htdocs' or '/var/www' folder
LOCAL_URL="http://localhost/yoursite"
REMOTE_URL="https://yourlivesite.com"

# SSH credentials
SSH_USER="username"
SSH_HOST="example.com"
SSH_PORT="22"

# the filename of the exported/imported SQL file
SQL_FILENAME="db.sql"

# remote database credentials (can be found in wp-config.php)
# NOTE: put these in a file called ".env" in same folder as this script - DONT PUT YOUR PASSWORD HERE
REMOTE_DB=""
REMOTE_DB_USER=""
REMOTE_DB_PASSWORD=""

# local database credentials (possibly found in localhost/phpmyadmin)
LOCAL_DB_USER="root"
LOCAL_DB_PASSWORD="root"

# the remote mysql file created on the server
SERVER_SQL_FILE="/home/path/to/filename.sql"

# change this to your mysql executable path if not using MAMP
MYSQL_BIN_PATH="/Applications/MAMP/Library/bin/"

# add mysql to shell path to prevent "command mysql not found"
export PATH=$PATH:$MYSQL_BIN_PATH

# check for errors and display a message
errorcheck() {
	STATE=$?
	SUCCESS_MSG=${1:-"- Success."}
	ERROR_MSG=${2:-"- An error occurred."}
	if [ $STATE -eq 0 ]; then
	echo $SUCCESS_MSG
	else
	echo $ERROR_MSG
	exit 1
	fi
}

# source variables from .env file if it exists
if [ -f ./.env ]; then
	echo ".env detected, importing environment variables"
	source ./.env
else
	echo "no .env detected... you're not adding sensitive information directly to the script file are you?"
fi

{
# skip remote DB export if no password provided
if [ -z "$REMOTE_DB_PASSWORD" ]; then
	echo "No password detected, skipping server SQL export"
else
	# export db file from server
	echo "Exporting remote database to server at $SERVER_SQL_FILE..."
	ssh $SSH_USER@$SSH_HOST -p $SSH_PORT "mysqldump --user=$REMOTE_DB_USER --password='$REMOTE_DB_PASSWORD' $REMOTE_DB > $SERVER_SQL_FILE"
	errorcheck
fi

# download the mysql file from the WP Engine server
echo "Getting SQL file from $SERVER_SQL_FILE at $SSH_HOST..."
scp -P $SSH_PORT $SSH_USER@$SSH_HOST:$SERVER_SQL_FILE ./$SQL_FILENAME
errorcheck

# exit if for some reason there's no db file in the repo folder
if [ ! -f ./$SQL_FILENAME ]; then
	echo "Couldnt find ./$SQL_FILENAME, exiting..."
	exit 1;
fi

# drop db and create empty one with same name
echo "Deleting existing DB and replacing..."
mysql --user=$LOCAL_DB_USER --password="$LOCAL_DB_PASSWORD" --execute="DROP DATABASE IF EXISTS $LOCAL_DB; CREATE DATABASE $LOCAL_DB;"
errorcheck

# replace the local db with the download
echo "Replacing local database with remote..."
mysql --user=$LOCAL_DB_USER --password="$LOCAL_DB_PASSWORD" $LOCAL_DB < $SQL_FILENAME
errorcheck

# update siteurl and home in DB
echo "Updating wp_options table & running find/replace..."
mysql --user=$LOCAL_DB_USER --password="$LOCAL_DB_PASSWORD" <<EOF
	USE $LOCAL_DB;
	UPDATE wp_options SET option_value="$LOCAL_URL" WHERE option_name="siteurl";
	UPDATE wp_options SET option_value="$LOCAL_URL" WHERE option_name="home";
	UPDATE wp_posts SET post_content = replace(post_content, '$REMOTE_URL', '$LOCAL_URL');
	UPDATE wp_postmeta SET meta_value = replace(meta_value,'$REMOTE_URL','$LOCAL_URL');
EOF
errorcheck

} 2>/dev/null # suppress warnings

errorcheck "Successfully pulled database!" "There was a problem pulling the database."
