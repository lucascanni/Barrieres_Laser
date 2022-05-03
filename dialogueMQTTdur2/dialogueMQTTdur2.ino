#include <Wire.h>
#include <PubSubClient.h>
#include <WiFi.h>
#include <DS3231.h>

#define _pinBP1 34
#define _pinBP12 35
#define _pinBP2 32
unsigned long interBarriere = 0, barriere1 = 0;
volatile boolean flag = false;
volatile int t11 = 0, t21 = 0, t12 = 0;
byte Year ;
byte Month ;
byte Date ;
byte DoW ;
byte Hour ;
byte Minute ;
byte Second ;
bool Century  = false;
bool h12 ;
bool PM ;
String str_dateTime = "";
String str_dateTime11 = "";
char sz_dateTime[25];
char sz_dateTimeInit[25];
const char* ssid = "wireless_cdf";
const char* password =  "1A2B3C4D5E";
const char* mqtt_server = "192.168.1.20";

//Objects
DS3231 Clock;
IPAddress ip(192, 168, 1, 30);
IPAddress gateway(192, 168, 1, 254);
IPAddress subnet(255, 255, 255, 0);

WiFiClient espClient;
PubSubClient client(espClient);

void setup() {
  pinMode(_pinBP1, INPUT);
  pinMode(_pinBP12, INPUT);
  pinMode(_pinBP2, INPUT);
  Serial.begin(115200);
  setup_wifi();
  Wire.begin();
  client.setServer(mqtt_server, 1883);
  attachInterrupt(_pinBP1, appui1, RISING);
  attachInterrupt(_pinBP2, appui2, RISING);
  attachInterrupt(_pinBP12, relache, FALLING);
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
  t11 = millis();
  RTC();
}

void relache() {
  t12 = millis();
}

void appui2() {
  t21 = millis();
  flag = true;
}

void reconnect() {
  // Loop until we're reconnected
  while (!client.connected()) {
    Serial.print("Attempting MQTT connection...");
    // Attempt to connect
    if (client.connect("ESP8266Client","pi","raspberry")) {
      Serial.println("connected");
      RTC_init(); 
      str_dateTime.toCharArray(sz_dateTimeInit,str_dateTime.length()+1);
      client.publish("laser/init",sz_dateTimeInit);
      Serial.print("Envoi date/heure : ");
      Serial.println(sz_dateTimeInit);
    } else {
      Serial.print("failed, rc=");
      Serial.print(client.state());
      Serial.println(" try again in 5 seconds");
      // Wait 5 seconds before retrying
      delay(5000);
    }
  }
}

void RTC_init( ) { /* function readRTC */
 ////Read Real Time Clock
 /*Year = Clock.getYear();
 Month = Clock.getMonth(Century);
 Date = Clock.getDate();
 Hour = Clock.getHour(h12, PM);
 Minute = Clock.getMinute();
 Second = Clock.getSecond();*/
 str_dateTime = "22-04-26 09:26:30";
 /*str_dateTime += String(Year); 
 str_dateTime += '-'; 
 str_dateTime += String(Month); 
 str_dateTime += '-';
 str_dateTime += (Date); 
 str_dateTime += ' ';
 str_dateTime += String(Hour); 
 str_dateTime += ':'; 
 str_dateTime += String(Minute); 
 str_dateTime += ':'; 
 str_dateTime += String(Second);*/
 delay(1000);
}

void RTC( ) { /* function readRTC */
 ////Read Real Time Clock
 /*Year = Clock.getYear();
 Month = Clock.getMonth(Century);
 Date = Clock.getDate();
 Hour = Clock.getHour(h12, PM);
 Minute = Clock.getMinute();
 Second = Clock.getSecond();
 str_dateTime = "";
 str_dateTime += String(Year); 
 str_dateTime += '-'; 
 str_dateTime += String(Month); 
 str_dateTime += '-';
 str_dateTime += (Date); 
 str_dateTime += ' ';
 str_dateTime += String(Hour); 
 str_dateTime += ':'; 
 str_dateTime += String(Minute); 
 str_dateTime += ':'; 
 str_dateTime += String(Second);*/
 str_dateTime = "22-04-26 09:26:30";
 delay(1000);
}

void loop() {

  if (!client.connected()) {
    reconnect();
  }
  client.loop();
  
  if(flag == true){
   if((WiFi.status()== WL_CONNECTED) 
   && ((t11 > 0) && (t12 > 0) && (t21 > 0)) 
   && ((t21 > t11)&&(t12 > t11) && (t21 > t12))){  
    
     interBarriere = t21 - t11;
     barriere1 = t12 - t11;
     str_dateTime += " ";
     str_dateTime += String(interBarriere);
     str_dateTime += " ";
     str_dateTime += String(barriere1);
     str_dateTime.toCharArray(sz_dateTime,str_dateTime.length()+1);
     client.publish("laser/intTemps",sz_dateTime);
     Serial.println(sz_dateTime);
     
    
   }else{
    
      Serial.println("Error in WiFi connection");   
    
   }
    
    flag = false;
  }
}
