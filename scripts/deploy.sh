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

./scripts/deploy-app-files.sh
sleep 2
./scripts/deploy-controller-files.sh
sleep 2
./scripts/deploy-diagnostic-files.sh
sleep 2
./scripts/deploy-helper-files.sh
sleep 2
./scripts/deploy-repository-files.sh
sleep 2
./scripts/deploy-rootfiles.sh
sleep 2
./scripts/deploy-view-files.sh

