#include <EEPROM.h>

#define EEPROM_SIZE 20

void setup() 
{
  Serial.begin(115200);
  Serial.println(F("Initialize System")); 
  EEPROM.begin(EEPROM_SIZE);

 String str_ip, str_gateway, str_subnet, str_ssid, str_password, str_mqtt_server, str_choix;
 char ip[15+1], gateway[15+1], subnet[15+1], ssid[30+1], password[30+1], mqtt_server[30+1];
 int addIp = 0, addGateway = 16, addSubnet = 32, addSsid = 63, addPassword = 94, addMqtt_serveur = 125;
 str_ip = EEPROM.read(addIp);
 
 Serial.print("Ip : ");
 Serial.println(str_ip);
 Serial.println("Voulez-vous saisir un nouveau module ? (y/n)");
 
 Serial.setTimeout(30000);
 str_choix = Serial.readStringUntil('\n');
 
 if(str_choix == "n" || str_choix == 0)
 {
    Serial.print("Ip : ");
    Serial.println(str_ip);

    Serial.print("Passerelle : ");
    Serial.println(str_gateway);

    Serial.print("Masque : ");
    Serial.println(str_subnet);

    Serial.print("SSID : ");
    Serial.println(str_ssid);

    Serial.print("Mot de passe : ");
    Serial.println(str_password);

    Serial.print("Ip du serveur MQTT : ");
    Serial.println(str_mqtt_server);
 }
 else
 {
  Serial.print("Saisir l'ip du module : ");
  Serial.setTimeout(20000);
  str_ip = Serial.readStringUntil('\n'); 
  //Allocation mémoire
  //ip=new char[str_ip.length()+1];
  str_ip.toCharArray(ip, str_ip.length() + 1);
  Serial.println(ip);

  Serial.print("Saisir la passerelle : ");
  Serial.setTimeout(20000);
  str_gateway = Serial.readStringUntil('\n'); 
  //gateway=new char[str_gateway.length()+1];
  str_gateway.toCharArray(gateway, str_gateway.length() + 1);
  Serial.println(gateway);

  Serial.print("Saisir le masque : ");
  Serial.setTimeout(20000);
  str_subnet = Serial.readStringUntil('\n'); 
  //subnet=new char[str_subnet.length()+1];
  str_subnet.toCharArray(subnet, str_subnet.length() + 1);
  Serial.println(subnet);

  Serial.print("Saisir le SSID : ");
  Serial.setTimeout(20000);
  str_ssid = Serial.readStringUntil('\n'); 
  //ssid=new char[str_ssid.length()+1];
  str_ssid.toCharArray(ssid, str_ssid.length() + 1);
  Serial.println(ssid);

  Serial.print("Saisir le mot de passe : ");
  Serial.setTimeout(20000);
  str_password = Serial.readStringUntil('\n'); 
  //password=new char[str_password.length()+1];
  str_password.toCharArray(password, str_password.length() + 1);
  Serial.println(password);

  Serial.print("Saisir l'ip du serveur MQTT : ");
  Serial.setTimeout(20000);
  str_mqtt_server = Serial.readStringUntil('\n'); 
  //mqtt_server=new char[str_mqtt_server.length()+1];
  str_mqtt_server.toCharArray(mqtt_server, str_mqtt_server.length() + 1);
  Serial.println(mqtt_server);
  
  for(unsigned int i=0; i<sizeof(ip); i++){
    if(ip[i] == '0'){
      break;
    }
    EEPROM.write(addIp + i, ip[i]);
  }

  for(unsigned int i=0; i<sizeof(gateway); i++){
    if(gateway[i] == '0'){
      break;
    }
    EEPROM.write(addGateway + i, gateway[i]);
  }

  for(unsigned int i=0; i<sizeof(subnet); i++){
    if(subnet[i] == '0'){
      break;
    }
    EEPROM.write(addSubnet + i, subnet[i]);
  }

  for(unsigned int i=0; i<sizeof(ssid); i++){
    if(ssid[i] == '0'){
      break;
    }
    EEPROM.write(addSsid + i, ssid[i]);
  }

  for(unsigned int i=0; i<sizeof(password); i++){
    if(password[i] == '0'){
      break;
    }
    EEPROM.write(addPassword + i, password[i]);
  }

  for(unsigned int i=0; i<sizeof(mqtt_server); i++){
    if(mqtt_server[i] == '0'){
      break;
    }
    EEPROM.write(addMqtt_serveur + i, mqtt_server[i]);
  }
  
  EEPROM.commit();
  
  Serial.println("Le nouveau module est : "); 
  Serial.print("Ip : ");
  for(unsigned int i=addIp; i<addGateway; i++){
      EEPROM.read(i);
    }
  Serial.println(" ");
  Serial.print("Passerelle : ");
  for(unsigned int i=addGateway; i<addSubnet; i++){
      EEPROM.read(i);
    }
  Serial.println(" ");
  Serial.print("Masque : ");
  for(unsigned int i=addSubnet; i<addSsid; i++){
      EEPROM.read(i);
    }
  Serial.println(" ");

  Serial.print("SSID : ");
  for(unsigned int i=addSsid; i<addPassword; i++){
      EEPROM.read(i);
    }
  Serial.println(" ");

  Serial.print("Mot de passe : ");
  for(unsigned int i=addPassword; i<addMqtt_serveur; i++){
      EEPROM.read(i);
    }
  Serial.println(" ");
  Serial.print("Ip du serveur MQTT : ");
  for(unsigned int i=addMqtt_serveur; i<addGateway+16; i++){
      EEPROM.read(i);
    }
  Serial.println(" ");
 }
}

void loop()
{
}
