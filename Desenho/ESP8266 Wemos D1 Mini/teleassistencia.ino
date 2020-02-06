#include <EEPROM.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <Wire.h>
#include "TinyGPS++.h" // https://github.com/mikalhart/TinyGPSPlus
#include <ArduinoJson.h> // https://arduinojson.org/

// servidor que disponibiliza serviço de geolocalização via IP
const char* IpApiHost = "ip-api.com";

// The TinyGPS++ object
static const uint32_t GPSBaud = 9600;
TinyGPSPlus gps;


// WiFi judas@docapesca
//const char* ssid = "Docapesca IoT";
//const char* ssid = "Docapesca";
//const char* ssid = "VReal3";
const char* ssid = "NCC1701";
const char* password = "acoddoca";
WiFiClient client;

String board_id = "Wemos D1 Mini Dev";
//String lat = "37.222260";
//String lng = "-7.459044";
String zona = "Castro Marim";
String lat = "0";
String lng = "0";
String geo = "none";
String sensor1 = "Não pressionado";
String sensor2 = "Não foi detectada queda.";
String sensor3 = "4.22";
String estado = "1";
String contacto = "11111, Rycki; 22222, Morty";

const char *host = "jfaria.org";
const int httpsPort = 443;  //HTTPS= 443 and HTTP = 80
//SHA1 finger print of certificate use web browser to view and copy
const char fingerprint[] PROGMEM = "42 0F 47 07 56 7B F0 13 30 0E CB F7 E7 2C 6A B9 3E A1 AD 88";

const int buttonPin = D6;
int buttonState = 0;
const int remotePin = D5;
int remoteState = 0;
const int buzzerPin = D3;
const int ledPin = BUILTIN_LED; // LED = D4

const int MPU_addr = 0x68; // I2C address of the MPU-6050
int16_t AcX, AcY, AcZ, Tmp, GyX, GyY, GyZ;
float GfX, GfY, GfZ, Gf;
float Gyro_angle_X, Gyro_angle_Y, Gyro_angle_Z, GyDt, Gy;
const float Acc_threshold = 0.5;
const float Gy_threshold = 450;

int report = 0; // report state
int retrycounter = 30; // https connecting retry conter

void setup()
{

  pinMode(ledPin, OUTPUT);
  pinMode(buzzerPin, OUTPUT);
  pinMode(buttonPin, INPUT_PULLUP);
  pinMode(remotePin, INPUT);
  beep();

  // Initialize a serial connection for reporting values to the host
  Serial.begin(GPSBaud);
  while (!Serial) { // this is because of the leonard board bug....
    delay(10); // wait until serial "opens"
  }
  Serial.println("\nSerial initialized.");

  /*
    Wire.begin();
    Wire.beginTransmission(MPU_addr);
    Wire.write(0x6B);  // PWR_MGMT_1 register
    Wire.write(0);     // set to zero (wakes up the MPU-6050)
    Wire.endTransmission(true);
  */
  initializeMPU6050();

  WiFi.mode(WIFI_STA); // this is because of the BUG!!!!
  //WiFi.setOutputPower(20);

  scanWiFi();

  delay(1000);

  startWIFI();

  Serial.println("\n ---------");
  Serial.println("|  READY  |");
  Serial.println(" ---------");
  beep();
  beep();
}

/**
   Main program loop
*/
void loop()
{

  if (WiFi.status() == WL_CONNECTED )
  {
    /*while (Serial.available() > 0)
      if (gps.encode(Serial.read()))
        readGeo();
    */
    // if the push button pressed, switch on the LED
    buttonState = digitalRead(buttonPin);
    remoteState = digitalRead(remotePin); // BUG BUG BUG BUG BUG BUG BUG BUG BUG BUG BUG BUG BUG BUG BUG BUG BUG BUG BUG BUG BUG BUG BUG BUG BUG BUG BUG BUG BUG BUG BUG BUG BUG
    //if (buttonState == LOW || remoteState == HIGH) {
    //if (remoteState == HIGH) {
    if (remoteState == LOW) { // HIGH = BOARD WITH REMOTE!!
      digitalWrite(ledPin, LOW);  // LED on
      report = 1; // 0 = test
      sensor1 = "Botão SOS Pressionado";
      Serial.println("\n ----------------------");
      Serial.println("|  Remote SOS Pressionado !  |");
      Serial.println("|  REPORT ACTIVATED !  |");
      Serial.println(" ----------------------");
      beep();
    } else if (buttonState == LOW) {
      digitalWrite(ledPin, LOW);  // LED on
      report = 1; // 0 = test
      sensor1 = "Botão SOS Pressionado";
      Serial.println("\n ----------------------");
      Serial.println("|  Botao Pressionado !  |");
      Serial.println("|  REPORT ACTIVATED !  |");
      Serial.println(" ----------------------");
      beep();
    } else {
      sensor1 = "Não pressionado";
    }

    readMPU6050();

    if (report == 1) {

      // Get position frmo GPS, or from IP
      readGeo();

      //HTTPClient http;
      Serial.println("\n  ---------------");
      Serial.println(" | Upload Report |");
      Serial.println("  ---------------");
      WiFiClientSecure httpsClient;
      Serial.printf("Report server: '%s'\n", host);
      Serial.printf("Using SHA1 fingerprint '%s'\n", fingerprint);
      httpsClient.setFingerprint(fingerprint);
      httpsClient.setTimeout(15000); // 15 Seconds
      delay(1000);
      Serial.println("HTTPS Connecting ...");
      int r = 0; //retry counter
      while ((!httpsClient.connect(host, httpsPort)) && (r < retrycounter)) {
        delay(100);
        Serial.print(".");
        r++;
      }
      if (r == retrycounter) {
        Serial.println("Connection failed");
      }
      else {
        Serial.println("Successful connected to web, uploading report...");

        String getData, Link;

        //POST Data
        Link = "/siresp/post-esp-data.php";

        // Prepare your HTTP POST request data
        String httpRequestData = "board_id=" + board_id
                                 + "&zona=" + zona
                                 + "&lat=" + lat
                                 + "&lng=" + lng
                                 + "&geo=" + geo
                                 + "&sensor1=" + sensor1
                                 + "&sensor2=" + sensor2
                                 + "&sensor3=" + sensor3
                                 + "&estado=" + estado
                                 + "&contacto=" + contacto
                                 + "";

        Serial.print("String size:: "); Serial.println(httpRequestData.length());
        Serial.print("Requesting POST to: "); Serial.print(host); Serial.println(Link);
        /*
          POST /post HTTP/1.1
          Host: postman-echo.com
          Content-Type: application/x-www-form-urlencoded
          Content-Length: 85

          board_id=wemos&lat=37.123&lng=-7.4222&geo=geo&sensor1=1&sensor2=1&sensor3=1&estado=1

        */
        httpsClient.print(String("POST ") + Link + " HTTP/1.1\r\n" +
                          "Host: " + host + "\r\n" +
                          "Content-Type: application/x-www-form-urlencoded" + "\r\n" +
                          "Content-Length: " + httpRequestData.length() + "\r\n\r\n" +
                          httpRequestData + "\r\n" +
                          "Connection: close\r\n\r\n");

        Serial.println("request sent");

        while (httpsClient.connected()) {
          String line = httpsClient.readStringUntil('\n');
          if (line == "\r") {
            Serial.println("headers received");
            break;
          }
        }

        //Serial.println("Server reply:");
        String line;
        while (httpsClient.available()) {
          line = httpsClient.readStringUntil('\n');  //Read Line by Line
          //Serial.println(line); //Print response
        }

        Serial.println(" ----------------------");
        Serial.println("|  Closing Connection  |");
        Serial.println(" ----------------------");

        //delay(10000);
        report = 0;
        digitalWrite(ledPin, HIGH); // LED off
      }
    }
  } else {
    beep();
    startWIFI();
  }

}



void readGeo()
{
  Serial.println("\n  --------------");
  Serial.println(" | GPS Location |");
  Serial.println("  --------------");

  while (Serial.available() > 0) {
    gps.encode(Serial.read());
  }

  if (gps.location.isValid()) {
    lat = String(gps.location.lat(), 6);
    lng = String(gps.location.lng(), 6);
    geo = "Sinal GPS";
    Serial.print(lat);
    Serial.print(" , ");
    Serial.println(lng);
  } else {
    //lat = "0";
    //lng = "0";
    geo = "Sinal de GPS nao disponivel";
    Serial.println(F("INVALID"));
    Serial.println("No GPS, using location by IP");
    readGeoIP();
  }
}

void readGeoIP()
{
  Serial.println("\n  -------------------");
  Serial.println(" | GeoLocation by IP |");
  Serial.println("  -------------------");
  if ( !client.connect(IpApiHost, 80) ) {
    Serial.println("connection to ip-api.com failed... no soup for you... and you... and you...");
  } else {
    // Realiza HTTP GET request
    client.println("GET /json/?fields=lat,lon HTTP/1.1");
    client.print("Host: ");
    client.println(IpApiHost);
    client.println("Connection: close");
    client.println();

    while (client.connected()) {
      String line = client.readStringUntil('\n');
      Serial.println("headers received");
      if (line == "\r") {
        break;
      }
    }

    Serial.println("Server reply:");
    String line;
    while (client.available()) {
      line = client.readStringUntil('\n');  //Read Line by Line
      Serial.println(line); //Print response
    }

    // recebe os dados de geolocalização em formato JSON e guarda na variável data
    StaticJsonDocument<200> doc;
    // Deserialize the JSON document
    DeserializationError error = deserializeJson(doc, line);

    // Test if parsing succeeds.
    if (error) {
      Serial.print(F("deserializeJson() failed: "));
      Serial.println(error.c_str());
    }

    //lat = String(doc["lat"], 6);
    //lng = String(doc["lon"], 6);
    double latitude = doc["lat"];
    double longitude = doc["lon"];
    lat = String (latitude, 6);
    lng = String (longitude, 6);

    Serial.print("Posicao: "); //Print response
    Serial.print(latitude, 6); //Print response
    Serial.print(" , "); //Print response
    Serial.println(longitude, 6); //Print response

    //Serial.println(line); //Print response
  }
}

void startWIFI(void) {
  Serial.println("\n  ------------");
  Serial.println(" | Start WiFi |");
  Serial.println("  ------------");

  delay(100);

  WiFi.begin(ssid, password); // Connect to the network
  Serial.print("Connecting to ");
  Serial.print(ssid);
  Serial.println(" ...");
  int i = 0;
  digitalWrite(BUILTIN_LED, LOW);    // turn the LED off by making the voltage LOW
  delay(100);

  while (WiFi.status() != WL_CONNECTED) { // Wait for the Wi-Fi to connect
    digitalWrite(BUILTIN_LED, HIGH);   // turn the LED on (HIGH is the voltage level)
    delay(2000);
    Serial.print(++i);
    Serial.print('.');
    digitalWrite(BUILTIN_LED, LOW);    // turn the LED off by making the voltage LOW
    delay(100);
  }
  delay(2000);
  //WiFi.config(ip, gateway, subnet);

  Serial.print('\n');
  Serial.println("Connection established! ");
  Serial.print("IP address: \t");
  Serial.println(WiFi.localIP()); // Send the IP address of the ESP8266 to the computer
}

void readMPU6050()
{
  // READ VALUES FROM MPU6050
  Wire.beginTransmission(MPU_addr);
  Wire.write(0x3B);  // starting with register 0x3B (ACCEL_XOUT_H)
  Wire.endTransmission(false);
  Wire.requestFrom(MPU_addr, 6, true); // request a total of 6 registers
  AcX = Wire.read() << 8 | Wire.read(); // 0x3B (ACCEL_XOUT_H) & 0x3C (ACCEL_XOUT_L)
  AcY = Wire.read() << 8 | Wire.read(); // 0x3D (ACCEL_YOUT_H) & 0x3E (ACCEL_YOUT_L)
  AcZ = Wire.read() << 8 | Wire.read(); // 0x3F (ACCEL_ZOUT_H) & 0x40 (ACCEL_ZOUT_L)
  GfX = (AcX / 2048.0) - 0.05;
  GfY = (AcY / 2048.0) + 0.02;
  GfZ = (AcZ / 2048.0) + 0.11;
  Gf = sqrt(sq(GfX) + sq(GfY) + sq(GfZ)) - 1;
  if (Gf < 0) {
    Gf = Gf * -1;
  }
  //Serial.print("\t Acc: "); Serial.print(Gf);

  // READ GYRO VALUES FROM MPU6050
  Wire.beginTransmission(MPU_addr);
  Wire.write(0x43);  // starting with register 0x3B (ACCEL_XOUT_H)
  Wire.endTransmission(false);
  Wire.requestFrom(MPU_addr, 6, true); // request a total of 6 registers  GyX=Wire.read()<<8|Wire.read();  // 0x43 (GYRO_XOUT_H) & 0x44 (GYRO_XOUT_L)
  GyX = Wire.read() << 8 | Wire.read(); // 0x43 (GYRO_XOUT_H) & 0x44 (GYRO_YOUT_L)
  GyY = Wire.read() << 8 | Wire.read(); // 0x45 (GYRO_YOUT_H) & 0x46 (GYRO_ZOUT_L)
  GyZ = Wire.read() << 8 | Wire.read(); // 0x47 (GYRO_ZOUT_H) & 0x48 (GYRO_ZOUT_L)
  GyX = (GyX / 32.8) - 2;
  GyY = (GyY / 32.8);
  GyZ = (GyZ / 32.8);
  Gy = sqrt(sq(GyX) + sq(GyY) + sq(GyZ));
  //Gyro_angle_X = GyX * dt;
  //Gyro_angle_Y = GyY * dt;
  //Gyro_angle_Z = GyZ * dt;
  //GyDt = sqrt(sq(Gyro_angle_X) + sq(Gyro_angle_Y) + sq(Gyro_angle_Z));
  //Serial.print("\t GyX \t"); Serial.print(GyX);
  //Serial.print("\t GyY \t"); Serial.print(GyY);
  //Serial.print("\t GyZ \t"); Serial.print(GyZ);
  //Serial.print("\t GyDt \t"); Serial.print(GyDt);
  //Serial.print("\t Gy \t"); Serial.print(Gy);

  //Serial.println(" ");

  int queda = 0;
  if (Gf > Acc_threshold && Gy > 500 ) {
    queda = queda + 1;
  }
  if (Gf > 2 && Gy > 250) {
    queda = queda + 2;
  }
  if (Gf > Acc_threshold && Gy > 800) {
    queda = queda + 4;
  }

  if (queda > 0) {
    Serial.println("\n ----------------------");
    Serial.print("| Queda ");
    Serial.print(queda);
    Serial.println(" Detectada !  |");
    Serial.println("|  REPORT ACTIVATED !  |");
    Serial.println(" ----------------------");
    beep();
    report = 1;
    sensor2 = "Queda Detectada";
  } else {
    sensor2 = "Não foi detectada queda.";
  }
}

void scanWiFi() {
  Serial.println("\n  ----------");
  Serial.println(" | WiFiScan |");
  Serial.println("  ----------");

  Serial.print("scan start ... ");

  // WiFi.scanNetworks will return the number of networks found
  int n = WiFi.scanNetworks();
  Serial.println("scan done");
  if (n == 0) {
    Serial.println("no networks found");
  } else {
    Serial.print(n);
    Serial.println(" networks found");
    for (int i = 0; i < n; ++i) {
      // Print SSID and RSSI for each network found
      Serial.print(i + 1);
      Serial.print(": ");
      Serial.print(WiFi.SSID(i));
      Serial.print(" (");
      Serial.print(WiFi.RSSI(i));
      Serial.print(")");
      Serial.println((WiFi.encryptionType(i) == ENC_TYPE_NONE) ? " " : "*");
      delay(10);
    }
  }
  Serial.println("");

  // Wait a bit before scanning again
  delay(2000);
}

void initializeMPU6050()
{
  Wire.begin();

  Wire.beginTransmission(MPU_addr);
  Wire.write(0x6B);  // PWR_MGMT_1 register
  Wire.write(0);     // set to zero (wakes up the MPU-6050)
  Wire.endTransmission(true);

  // Configure Accelerometer Sensitivity - Full Scale Range (default +/- 2g)
  Wire.beginTransmission(MPU_addr);
  Wire.write(0x1C);                  //Talk to the ACCEL_CONFIG register (1C hex)
  Wire.write(0x18);                  //Set the register bits as 00011000 (+/- 16g full scale range)
  Wire.endTransmission(true);

  // Configure Gyro Sensitivity - Full Scale Range (default +/- 250deg/s)
  Wire.beginTransmission(MPU_addr);
  Wire.write(0x1B);                   // Talk to the GYRO_CONFIG register (1B hex)
  Wire.write(0x10);                   // Set the register bits as 00010000 (1000deg/s full scale)
  Wire.endTransmission(true);
  delay(100);

  // READ VALUES FROM MPU6050
  Wire.beginTransmission(MPU_addr);
  Wire.write(0x3B);  // starting with register 0x3B (ACCEL_XOUT_H)
  Wire.endTransmission(false);
  Wire.requestFrom(MPU_addr, 6, true); // request a total of 6 registers
  AcX = Wire.read() << 8 | Wire.read(); // 0x3B (ACCEL_XOUT_H) & 0x3C (ACCEL_XOUT_L)
  AcY = Wire.read() << 8 | Wire.read(); // 0x3D (ACCEL_YOUT_H) & 0x3E (ACCEL_YOUT_L)
  AcZ = Wire.read() << 8 | Wire.read(); // 0x3F (ACCEL_ZOUT_H) & 0x40 (ACCEL_ZOUT_L)
  GfX = (AcX / 2048.0) - 0.05;
  GfY = (AcY / 2048.0) + 0.02;
  GfZ = (AcZ / 2048.0) + 0.11;
  Gf = sqrt(sq(GfX) + sq(GfY) + sq(GfZ)) - 1;
  if (Gf < 0) {
    Gf = Gf * -1;
  }

  Serial.println("\n  ----------");
  Serial.println(" |  MPU6050  |");
  Serial.println("  ----------");

  Serial.print("\nAcc: "); Serial.print(Gf);
  Serial.print("\tAccX: "); Serial.print(AcX);
  Serial.print("\tAccY: "); Serial.print(AcY);
  Serial.print("\tAccZ: "); Serial.print(AcZ);
  Serial.println("");

}

void beep() {
  digitalWrite(buzzerPin, HIGH);  // Buzzer on
  delay(200);
  digitalWrite(buzzerPin, LOW);  // LED on
  delay(100);
}
