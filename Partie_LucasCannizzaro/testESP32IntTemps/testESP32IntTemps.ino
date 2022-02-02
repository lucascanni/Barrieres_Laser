#include <Arduino.h>
#define _pinBP1 22
#define _pinBP2 19
unsigned long timer = 0;
volatile boolean changed = false;
volatile int tBp1 = 0, tBp2 = 0;

void setup()
{
  pinMode(_pinBP1, INPUT);
  pinMode(_pinBP2, INPUT);
  Serial.begin(9600);
  attachInterrupt(_pinBP1, appui1, RISING);
  attachInterrupt(_pinBP2, appui2, RISING);
}

void appui1() {
  changed = true;
  tBp1 = millis();
  Serial.println("Bouton 1");
}

void appui2() {
  changed = true;
  tBp2 = millis();
  Serial.println("Bouton 2");
}

void loop()
{
  if (changed){
    changed = false;
    if(((tBp1 != 0)&&(tBp2 != 0))&&(tBp1 < tBp2)){
      timer = tBp2-tBp1;
      Serial.print("Intervalle de temps : ");
      Serial.print(timer);
      Serial.println(" ms");
      tBp1 = 0;
      tBp2 = 0;
    }
  }
}
