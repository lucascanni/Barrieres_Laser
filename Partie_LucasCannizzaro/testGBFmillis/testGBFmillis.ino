#include <Arduino.h>
#define _pinFM 22
#define _pinFD 19
unsigned long timer = 0;
volatile boolean changed = false;
volatile unsigned long t11 = 0, t12 = 0;

void setup()
{
  pinMode(_pinFM, INPUT);
  pinMode(_pinFD, INPUT);
  Serial.begin(9600);
  attachInterrupt(_pinFM, FM, RISING);
  attachInterrupt(_pinFD, FD, FALLING);
}

void FM() {
  t11 = millis();
}

void FD() {
  t12 = millis();
  if(t11 != 0){
    noInterrupts();
    Serial.print("t11 = ");
    Serial.println(t11);
    Serial.print("t12 = ");
    Serial.println(t12);
  }
}


void loop()
{
  
  
  if(((t11 != 0)&&(t12 != 0))&&(t11 < t12)){
    timer = t12-t11;
    Serial.print("Intervalle de temps : ");
    Serial.print(timer);
    Serial.println(" ms");
    t11 = 0;
    t12 = 0; 
    interrupts();
    }
  
}
