#include <SoftwareSerial.h>

String readString = "";
String ID;
SoftwareSerial RFID(2,3);

void setup()
{
  Serial.begin(9600); //Start serial for PHP
  RFID.begin(9600); //Start serial for RFID
}

void loop()
{
  while(Serial.available())
  {
    while(RFID.available())
    {
      char b = RFID.read();
      ID += b;
      Serial.print("RFID=" + ID); //Send RFID to PHP
    }
    char c = Serial.read();
    readString += c;
  }
  
  if(readString.length() > 0)
  { // Read response and compares
    if(readString.substring(0, 2) == "Ok") //RFID found
      Serial.print("RFID found");
    else if(readString.substring(0, 2) == "No") //RFID not found
      Serial.print("RFID not found");
    readString = "";
  }
}
