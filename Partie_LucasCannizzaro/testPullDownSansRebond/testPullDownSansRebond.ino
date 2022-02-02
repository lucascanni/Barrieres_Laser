#include <Arduino.h>
#define _pinBP 22
int buttonState,memButtonState = 0, cmpt = 0;


void setup()
{
  pinMode(_pinBP, INPUT);
  Serial.begin(9600);

}


void loop()
{
  buttonState = digitalRead(_pinBP);
  if((buttonState == 1) and (memButtonState != buttonState)){
    Serial.println("front montant");
    memButtonState = buttonState;
    Serial.println(cmpt);
  }
  else if((buttonState == 0) and (memButtonState != buttonState)){
    Serial.println("front descendant");
    memButtonState = buttonState;
  }
}
