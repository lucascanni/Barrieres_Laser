//Libraries
#include <Wire.h>//https://www.arduino.cc/en/reference/wire
#include <DS3231.h>//https://github.com/NorthernWidget/DS3231
//Variables
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
//Objects
DS3231 Clock;
void setup() {
 //Init Serial USB
 Serial.begin(9600);
 Serial.println(F("Initialize System"));
 Wire.begin();
}
void loop() {
 readRTC();
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
