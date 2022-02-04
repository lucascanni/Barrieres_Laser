#!/usr/bin/env python3.5
#-*- coding: utf-8 -*-

import signal
import sys
import picamera
import datetime as dt
import RPi.GPIO as GPIO
import time

GPIO.setmode(GPIO.BCM)

BUTTON_GPIO = 16

GPIO.setup(BUTTON_GPIO, GPIO.IN, pull_up_down=GPIO.PUD_UP)


while True:
    try:  
        GPIO.wait_for_edge(BUTTON_GPIO, GPIO.FALLING)      
        with picamera.PiCamera() as camera:
            start = dt.datetime.now()
            camera.capture('/home/pi/Photos/''%s.jpg' % start)
  

    except:
        time.sleep(0.1)

