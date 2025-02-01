#!/bin/bash

# Set default values
FTP_HOST="ftp.objectivedynamics.myzen.co.uk"
REMOTE_DIR="/public_html/"
LOCAL_DIR="./"

# Convert Unix path to Windows path if needed
LOCAL_DIR=$(cygpath -w "$LOCAL_DIR" 2>/dev/null || echo "$LOCAL_DIR")

# Ensure local directory exists
if [ ! -d "$LOCAL_DIR" ]; then
    echo "Error: Local directory $LOCAL_DIR not found"
    exit 1
fi

# Create temporary FTP script
TMPFILE=$(mktemp -t ftp-script.XXXXXX)

# Create Windows-style FTP script
echo "open $FTP_HOST" > "$TMPFILE"
echo "$FTP_USER" >> "$TMPFILE"
echo "$FTP_PASS" >> "$TMPFILE"
echo "binary" >> "$TMPFILE"
echo "cd $REMOTE_DIR" >> "$TMPFILE"

# Create directories if they don't exist
echo "mkdir app/controllers" >> "$TMPFILE"

# Controllers
echo "cd app/controllers" >> "$TMPFILE"
echo "put \"$LOCAL_DIR\\app\\controllers\\FoodItemController.php\"" >> "$TMPFILE"
echo "put \"$LOCAL_DIR\\app\\controllers\\LoginController.php\"" >> "$TMPFILE"
echo "put \"$LOCAL_DIR\\app\\controllers\\TaggedFoodsController.php\"" >> "$TMPFILE"
echo "put \"$LOCAL_DIR\\app\\controllers\\TagsController.php\"" >> "$TMPFILE"
echo "put \"$LOCAL_DIR\\app\\controllers\\UpdateCategoriesController.php\"" >> "$TMPFILE"
echo "put \"$LOCAL_DIR\\app\\controllers\\UpdateFoodsController.php\"" >> "$TMPFILE"
echo "put \"$LOCAL_DIR\\app\\controllers\\UpdateFoodItemController.php\"" >> "$TMPFILE"

echo "cd ../../" >> "$TMPFILE"

echo "quit" >> "$TMPFILE"

# Execute FTP commands using Windows ftp
/c/Windows/System32/ftp.exe -s:"$TMPFILE"

# Clean up
rm "$TMPFILE"
echo "Upload complete!"
