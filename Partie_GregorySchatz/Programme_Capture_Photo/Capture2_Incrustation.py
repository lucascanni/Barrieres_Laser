#!/usr/bin/env python3.5
#-*- coding: utf-8 -*-

import signal
import sys
import picamera
from picamera import Color
import datetime as dt
import RPi.GPIO as GPIO
from time import sleep

GPIO.setmode(GPIO.BCM)

BUTTON_GPIO = 16

GPIO.setup(BUTTON_GPIO, GPIO.IN, pull_up_down=GPIO.PUD_UP)


while True:
    try:  
        GPIO.wait_for_edge(BUTTON_GPIO, GPIO.FALLING)      
        with picamera.PiCamera() as camera:
            camera.resolution = (2592, 1944)
            start = dt.datetime.now()
            date_titre = start.strftime("%Y/%m/%d, %H:%M:%S")
            camera.annotate_text = "Camera 1 | " + date_titre
            camera.annotate_text_size = 120
            sleep (0.01)
            camera.capture('/home/pi/Photos/''%s.jpg' % start)


    except:
        time.sleep(0.01)



