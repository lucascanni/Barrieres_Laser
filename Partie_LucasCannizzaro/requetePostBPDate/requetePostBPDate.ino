#include <ArduinoJson.h>
#include <WiFi.h>
#include <HTTPClient.h>
#include <Wire.h>
#include <DS3231.h>

#define _pinBP1 23
#define _pinBP2 19
unsigned long timer = 0;
volatile boolean flag = false;
volatile int tBp1 = 0, tBp2 = 0;
String output = "";
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

const char* ssid = "wireless_cdf";
const char* password =  "1A2B3C4D5E";

IPAddress ip(192, 168, 1, 30);
IPAddress gateway(192, 168, 1, 254);
IPAddress subnet(255, 255, 255, 0);

HTTPClient http;
DS3231 Clock;

void setup() {
  pinMode(_pinBP1, INPUT);
  pinMode(_pinBP2, INPUT);
  Serial.begin(115200);
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
     
    
  http.begin("http://192.168.1.20/Laser/new");  //Specify destination for HTTP request
  http.addHeader("Content-Type", "application/json"); //Specify content-type header
  
  Wire.begin();
  
  attachInterrupt(_pinBP1, appui1, RISING);
  attachInterrupt(_pinBP2, appui2, RISING);
}

void appui1() {
  tBp1 = millis();
}

void appui2() {
  tBp2 = millis();
  flag = true;
}

void readRTC( ) { /* function readRTC */
 ////Read Real Time Clock
 Year = Clock.getYear();
 Serial.print(Year, DEC);
 Serial.print("-");
 Month = Clock.getMonth(Century);
 Serial.print(Month, DEC);
 Serial.print("-");
 Date = Clock.getDate();
 Serial.print(Date, DEC);
 Serial.print(" ");
 Hour = Clock.getHour(h12, PM);
 Serial.print(Hour, DEC); //24-hr
 Serial.print(":");
 Minute = Clock.getMinute();
 Serial.print(Minute, DEC);
 Serial.print(":");
 Second = Clock.getSecond();
 Serial.println(Second, DEC);
 delay(1000);
}

void loop() {
  
  if(flag == true){
   if(WiFi.status()== WL_CONNECTED&&(((tBp1 != 0)&&(tBp2 != 0))&&(tBp1 < tBp2))){   //Check WiFi connection status
    
     
     timer = tBp2-tBp1;
     Serial.print("Intervalle de temps : ");
     Serial.print(timer);
     Serial.println(" ms");
     tBp1 = 0;
     tBp2 = 0;
     readRTC(); 
     StaticJsonDocument<32> doc;

     doc["value1"] = timer;
     doc["time"] = Year,"-",Month,"-",Date," ",Hour,":",Minute,":",Second;

     serializeJson(doc, output);
     
     int httpResponseCode = http.POST(output);   //Send the actual POST request
    
     if(httpResponseCode>0){
    
      String response = http.getString();                       //Get the response to the request
    
      Serial.println(httpResponseCode);   //Print return code
      Serial.println(response);           //Print request answer
    
     }else{
    
      Serial.print("Error on sending POST: ");
      Serial.println(httpResponseCode);
    
     }
    
     http.end();  //Free resources
    
   }else{
    
      Serial.println("Error in WiFi connection");   
    
   }
    
    delay(10000);  //Send a request every 10 seconds
    Serial.println("Data envoyé");
    output = "";
    flag = false;
  }
}
