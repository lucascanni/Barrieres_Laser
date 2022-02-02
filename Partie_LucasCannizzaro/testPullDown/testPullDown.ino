#include <Arduino.h>
#define BP 22
int buttonState;


void setup()
{
  pinMode(BP, INPUT);
  Serial.begin(9600);

}

void loop()
{
  buttonState = digitalRead(BP);
  Serial.println(buttonState);
}
