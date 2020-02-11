void loop()
{

  if (WiFi.status() == WL_CONNECTED )
  {
    buttonState = digitalRead(buttonPin);
    remoteState = digitalRead(remotePin);

    if (remoteState == LOW) {
      digitalWrite(ledPin, LOW);
      report = 1;
      sensor1 = "Botão SOS Pressionado";
      Serial.println("\n ----------------------");
      Serial.println("|  Remote SOS Pressionado !  |");
      Serial.println("|  REPORT ACTIVATED !  |");
      Serial.println(" ----------------------");
      beep();
    } else if (buttonState == LOW) {
      digitalWrite(ledPin, LOW);
      report = 1;
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

      // Get position from GPS, or from IP
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

		// POST to server
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

        String line;
        while (httpsClient.available()) {
          line = httpsClient.readStringUntil('\n');  //Read Line by Line
        }

        Serial.println(" ----------------------");
        Serial.println("|  Closing Connection  |");
        Serial.println(" ----------------------");

        report = 0;
        digitalWrite(ledPin, HIGH); // LED off
      }
    }
  } else {
    beep();
    startWIFI();
  }
}