#!/usr/bin/python3
# Importation du module paho-mqtt
import paho.mqtt.client as mqtt
# Importation du module pour executer une commande
import os

#test = "sudo date -s '22-1-1 1:0:0'"
#os.system(test)

# Instanciation du client
client = mqtt.Client('raspi_greg')

# Authentification du client
client.username_pw_set('pi', 'raspberry')
    
# Connexion du client au broker
client.connect('192.168.1.20')





# Abonnement à un topic
# Fonction callback pour l'arrivée d'un message
def on_message(client, userdata, message):
    print(str(message.payload.decode("utf-8")))
    # Définition de la commande à executer
    cmd = "sudo date -s '" + str(message.payload.decode("utf-8")) + "'"
    # Execution de la commande
    os.system(cmd)
    
# Armement de la fonction callback de réception de message
client.on_message = on_message
    
# Abonnement au topic
client.subscribe('laser/init')


# Boucle principale du programme
while True:
    client.loop()
            
   

    