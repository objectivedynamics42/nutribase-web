#!/bin/bash
# Show usage information
show_usage() {
    echo "Usage: $0 -u USERNAME -p PASSWORD [-h HOST] [-r REMOTE_DIR] [-l LOCAL_DIR]"
    echo
    echo "Required arguments:"
    echo "  -u    FTP username"
    echo "  -p    FTP password"
    echo
    echo "Optional arguments:"
    echo "  -h    FTP host (default: ftp.example.com)"
    echo "  -r    Remote directory (default: /public_html/uploads)"
    echo "  -l    Local directory (default: ./files_to_upload)"
    exit 1
}

# Set default values
FTP_HOST="ftp.objectivedynamics.myzen.co.uk"
REMOTE_DIR="/public_html/"
LOCAL_DIR="./"

# Parse command line arguments
while getopts "h:u:p:r:l:" opt; do
    case $opt in
        h) FTP_HOST="$OPTARG" ;;
        u) FTP_USER="$OPTARG" ;;
        p) FTP_PASS="$OPTARG" ;;
        r) REMOTE_DIR="$OPTARG" ;;
        l) LOCAL_DIR="$OPTARG" ;;
        ?) show_usage ;;
    esac
done

# Check for required arguments
if [ -z "$FTP_USER" ] || [ -z "$FTP_PASS" ]; then
    echo "Error: Username and password are required"
    show_usage
fi

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
echo "mkdir diag" >> "$TMPFILE"
echo "mkdir app" >> "$TMPFILE"
echo "mkdir app/controllers" >> "$TMPFILE"
echo "mkdir app/views" >> "$TMPFILE"
echo "mkdir app/repositories" >> "$TMPFILE"
echo "mkdir app/helpers" >> "$TMPFILE"

# Diagnostics
echo "cd diag" >> "$TMPFILE"
echo "put \"$LOCAL_DIR\\diag\\phpinfo.php\"" >> "$TMPFILE"
echo "cd ../../" >> "$TMPFILE"

echo "quit" >> "$TMPFILE"

# Execute FTP commands using Windows ftp
/c/Windows/System32/ftp.exe -s:"$TMPFILE"

# Clean up
rm "$TMPFILE"
echo "Upload complete!"
