#include <WiFi.h>
#include <HTTPClient.h>
#include <Arduino_JSON.h>

const char* ssid = "wireless_cdf";
const char* password =  "1A2B3C4D5E";

IPAddress ip(192, 168, 1, 30);
IPAddress gateway(192, 168, 1, 254);
IPAddress subnet(255, 255, 255, 0);

void setup() {
  
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
  
}
  
void loop() {
  
 if(WiFi.status()== WL_CONNECTED){   //Check WiFi connection status
  
   HTTPClient http;   
  
   http.begin("http://192.168.1.5/cerema/version1/laser/new");  //Specify destination for HTTP request
   http.addHeader("Content-Type", "text/plain");             //Specify content-type header
  
   int httpResponseCode = http.POST("POSTING from ESP32");   //Send the actual POST request
  
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
  
}
