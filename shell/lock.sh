#!/bin/sh
#https://unix.stackexchange.com/questions/22044/correct-locking-in-shell-scripts
lockdir=/var/tmp/mylock
pidfile=/var/tmp/mylock/pid

if ( mkdir ${lockdir} ) 2> /dev/null; then
        echo $$ > $pidfile
        trap 'rm -rf "$lockdir"; exit $?' INT TERM EXIT
        # do stuff here

        # clean up after yourself, and release your trap
        rm -rf "$lockdir"
        trap - INT TERM EXIT
else
        echo "Lock Exists: $lockdir owned by $(cat $pidfile)"
fi
