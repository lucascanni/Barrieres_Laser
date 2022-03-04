#include <WiFi.h>

const char* ssid = "wireless_cdf";
const char* password = "1A2B3C4D5E";

IPAddress ip(192, 168, 1, 30);
IPAddress gateway(192, 168, 1, 254);
IPAddress subnet(255, 255, 255, 0);

void setup(){
Serial.begin(115200);
delay(1000);

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

void loop(){}
