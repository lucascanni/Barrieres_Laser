#include <Arduino.h>
#define _pinBP 22
int buttonState,memButtonState = 0, cmpt = 0;
volatile boolean changed = false;

void setup()
{
  pinMode(_pinBP, INPUT);
  Serial.begin(9600);
  attachInterrupt(_pinBP, appui, RISING);
}

void appui() {
  changed = true;
  Serial.println("Appui sur le BP !");
  cmpt++;
}

void loop()
{
  if ( changed ) {
    changed = false;
    Serial.print("Appui : ");
    Serial.print(cmpt);
    Serial.println(" fois");
  }
  delay(10000);
}
