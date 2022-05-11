#include <Wire.h>
#include <PubSubClient.h>
#include <WiFi.h>

#define _pinBP1 23
#define _pinBP2 19
unsigned long timer = 0;
volatile boolean flag = false;
volatile int tBp1 = 0, tBp2 = 0;

const char* ssid = "wireless_cdf";
const char* password =  "1A2B3C4D5E";
const char* mqtt_server = "192.168.1.20";

IPAddress ip(192, 168, 1, 30);
IPAddress gateway(192, 168, 1, 254);
IPAddress subnet(255, 255, 255, 0);

WiFiClient espClient;
PubSubClient client(espClient);

void setup() {
  pinMode(_pinBP1, INPUT);
  pinMode(_pinBP2, INPUT);
  Serial.begin(115200);
  setup_wifi();
  client.setServer(mqtt_server, 1883);
  attachInterrupt(_pinBP1, appui1, RISING);
  attachInterrupt(_pinBP2, appui2, RISING);
}

void setup_wifi(){
  
  delay(4000);   //Delay needed before calling the WiFi.begin
  
  //on oublie l'ancienne config
  WiFi.disconnect(true);
  delay(1000);
  WiFi.mode(WIFI_STA);

  WiFi.config(ip, gateway, subnet);
  WiFi.begin(ssid, password); 
  Serial.println("\nConnecting");
  
  while(WiFi.status() != WL_CONNECTED){
    Serial.print(".");
    delay(100);
  }
  
  Serial.println("\nConnected to the WiFi network");
  Serial.print("[+] ESP32 IP : ");
  Serial.println(WiFi.localIP());
}

void appui1() {
  tBp1 = millis();
  Serial.print(timer);
  Serial.println(" ms");
}

void appui2() {
  tBp2 = millis();
  Serial.print(timer);
  Serial.println(" ms");
  flag = true;
}

void reconnect() {
  // Loop until we're reconnected
  while (!client.connected()) {
    Serial.print("Attempting MQTT connection...");
    // Attempt to connect
    if (client.connect("ESP32Client")) {
      Serial.println("connected");
      // Subscribe
      client.subscribe("snir/laser");
    } else {
      Serial.print("failed, rc=");
      Serial.print(client.state());
      Serial.println(" try again in 5 seconds");
      // Wait 5 seconds before retrying
      delay(5000);
    }
  }
}

void loop() {

  if (!client.connected()) {
    reconnect();
  }
  client.loop();
  
  if(flag == true){
   if(WiFi.status()== WL_CONNECTED&&(((tBp1 != 0)&&(tBp2 != 0))&&(tBp1 < tBp2))){   //Check WiFi connection status
    
     
     timer = tBp2-tBp1;
     Serial.print("Intervalle de temps : ");
     Serial.print(timer);
     Serial.println(" ms");
     tBp1 = 0;
     tBp2 = 0;
     char timerString[8];
     itoa(timer, timerString, 16);
     client.publish("snir/laser",timerString);
     
    
   }else{
    
      Serial.println("Error in WiFi connection");   
    
   }
    
    flag = false;
  }
}
