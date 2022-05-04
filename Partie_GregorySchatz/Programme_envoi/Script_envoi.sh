#!/bin/bash

while true
do
        DIR=$(ls -a /home/pi/Photos| sed -e "/\.$/d")

        if [ -n "$DIR" ]; then
               
				sshpass -p "raspberry" scp -r /home/pi/Photos pi@192.168.1.20:/var/www/html/img/
				#cd /home/pi/Photos/
				#rm -f *
                
        fi

done
