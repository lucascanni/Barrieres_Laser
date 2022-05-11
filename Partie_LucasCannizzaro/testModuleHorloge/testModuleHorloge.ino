#include <RTClib.h>
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
 setDate();//Comment once the date is set
 readRTC();
}
void readRTC( ) { /* function readRTC */
 ////Read Real Time Clock
 Serial.print(Clock.getYear(), DEC);
 Serial.print("-");
 Serial.print(Clock.getMonth(Century), DEC);
 Serial.print("-");
 Serial.print(Clock.getDate(), DEC);
 Serial.print(" ");
 Serial.print(Clock.getHour(h12, PM), DEC); //24-hr
 Serial.print(":");
 Serial.print(Clock.getMinute(), DEC);
 Serial.print(":");
 Serial.println(Clock.getSecond(), DEC);
 delay(1000);
}
void setDate( ) { /* function setDate */
 ////Set Real Time Clock
 if (Serial.available()) {
   //int _start = millis();
   GetDateStuff(Year, Month, Date, DoW, Hour, Minute, Second);
   Clock.setClockMode(false);  // set to 24h
   Clock.setSecond(Second);
   Clock.setMinute(Minute);
   Clock.setHour(Hour);
   Clock.setDate(Date);
   Clock.setMonth(Month);
   Clock.setYear(Year);
   Clock.setDoW(DoW);
 }
}
void GetDateStuff(byte& Year, byte& Month, byte& Day, byte& DoW, byte& Hour, byte& Minute, byte& Second) { /* function GetDateStuff */
 ////Get date data
 // Call this if you notice something coming in on
 // the serial port. The stuff coming in should be in
 // the order YYMMDDwHHMMSS, with an 'x' at the end.
 boolean GotString = false;
 char InChar;
 byte Temp1, Temp2;
 char InString[20];
 byte j = 0;
 while (!GotString) {
   if (Serial.available()) {
     InChar = Serial.read();
     InString[j] = InChar;
     j += 1;
     if (InChar == 'x') {
       GotString = true;
     }
   }
 }
 Serial.println(InString);
 // Read Year first
 Temp1 = (byte)InString[0] - 48;
 Temp2 = (byte)InString[1] - 48;
 Year = Temp1 * 10 + Temp2;
 // now month
 Temp1 = (byte)InString[2] - 48;
 Temp2 = (byte)InString[3] - 48;
 Month = Temp1 * 10 + Temp2;
 // now date
 Temp1 = (byte)InString[4] - 48;
 Temp2 = (byte)InString[5] - 48;
 Day = Temp1 * 10 + Temp2;
 // now Day of Week
 DoW = (byte)InString[6] - 48;
 // now Hour
 Temp1 = (byte)InString[7] - 48;
 Temp2 = (byte)InString[8] - 48;
 Hour = Temp1 * 10 + Temp2;
 // now Minute
 Temp1 = (byte)InString[9] - 48;
 Temp2 = (byte)InString[10] - 48;
 Minute = Temp1 * 10 + Temp2;
 // now Second
 Temp1 = (byte)InString[11] - 48;
 Temp2 = (byte)InString[12] - 48;
 Second = Temp1 * 10 + Temp2;
}
