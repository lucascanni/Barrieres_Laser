#!/bin/bash

while true
do
        DIR=$(ls -a /home/pi/Photos|  wc -l )

        if [ -n "$DIR" ]; then
                
                #sleep 1
                sshpass -p "raspberry" scp -r /home/pi/Photos pi@192.168.1.20:/var/www/html/
                cd /home/pi/Photos/
                rm -f *
                
        fi

done
