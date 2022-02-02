#include <Arduino.h>
#define _pinBP1 22
#define _pinBP2 19
int buttonState;
unsigned long timeur;
volatile unsigned long tps1 = 0, tps2 = 0;

void setup()
{
  pinMode(_pinBP1, INPUT);
  pinMode(_pinBP2, INPUT);
  Serial.begin(9600);
  attachInterrupt(_pinBP1, appui1, RISING);
  attachInterrupt(_pinBP2, appui2, RISING);
}

void appui1() {
  tps1 = millis();
}

void appui2() {
  tps2 = millis();
}

void loop()
{
  timeur = tps2-tps1;
  if(timeur > 0){
    Serial.print("time : ");
    Serial.println(timeur);
  }
  delay(10000);
}
