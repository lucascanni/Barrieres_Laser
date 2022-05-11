#!/bin/bash



while true
do
        DIR=$(ls /home/pi/Photos | wc -l )
        

        if [ $DIR = 3 ]; then
             
				sshpass -p "raspberry" scp -r /home/pi/Photos pi@192.168.1.20:/var/www/html/img/
				#cd /home/pi/Photos/
				#rm -f *
                
        fi

done
