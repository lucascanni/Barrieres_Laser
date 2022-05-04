#!/usr/bin/env python3.5
#-*- coding: utf-8 -*-

# Importation des librairies
import signal
import requests
import sys
import picamera
from picamera import Color
import datetime as dt
import RPi.GPIO as GPIO
from time import sleep

# Initialisation du GPIO
GPIO.setmode(GPIO.BCM)
BUTTON_GPIO = 16
GPIO.setup(BUTTON_GPIO, GPIO.IN, pull_up_down=GPIO.PUD_UP)

# Mise en place sous interruption 
while True:
    try:
        GPIO.wait_for_edge(BUTTON_GPIO, GPIO.FALLING)      
        with picamera.PiCamera() as camera:
            # Définition de la résolution des photos
            camera.resolution = (2592, 1944)
            # Récupération de l'heure de l'appareil
            start = dt.datetime.now()
            date_fichier = start.strftime("%F_%T")
            # Requête HTTP pour l'ID de la photo
            r = requests.get('http://192.168.1.20/Laser/id')
            reponse = r.text
            # Incrustation du nom de l'image sur l'image
            camera.annotate_text = reponse + "_" +date_fichier + "_CAM1"
            camera.annotate_text_size = 120
            sleep (0.01)
            # Capture de l'image et nommage avec la date et l'ID
            camera.capture('/home/pi/Photos/''%s%s%s%s.jpg' % (reponse , "_" , date_fichier , "_CAM1"))
    except:
        time.sleep(0.01)






