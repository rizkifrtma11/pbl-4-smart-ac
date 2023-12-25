#define BLYNK_TEMPLATE_ID "TMPL6LNcALJZ-"
#define BLYNK_TEMPLATE_NAME "nodemcudht11"
#define BLYNK_AUTH_TOKEN "6ALlja4ve2Q9uU-Wq6VuSsCElrH94WTx"

#define BLYNK_PRINT Serial
#include <ESP8266WiFi.h>
#include <BlynkSimpleEsp8266.h>
#include <Wire.h>
#include <RTClib.h>
#include <LiquidCrystal_I2C.h>
#include <DHT.h>
#include <WiFiUdp.h>
#include <NTPClient.h>  
#include <ESP8266HTTPClient.h>

RTC_DS3231 rtc;  
LiquidCrystal_I2C lcd(0x27, 16, 2);  
const int pirPin = 5;  

char auth[] = BLYNK_AUTH_TOKEN;
char ssid[] = "Limited";  
char pass[] = "Limited123";  

#define DHTPIN 2          
#define DHTTYPE DHT11     
DHT dht(DHTPIN, DHTTYPE);
BlynkTimer timer;

bool showTemperature = false;
bool motionDetected = false;  
WiFiUDP ntpUDP;  
NTPClient timeClient(ntpUDP, "pool.ntp.org");
const long TimeZoneInSeconds = 7 * 3600;

void setup() {
  Serial.begin(115200);

  Wire.begin();
  lcd.begin(16, 2);
  lcd.backlight();
  pinMode(pirPin, INPUT);

  WiFi.begin(ssid, pass);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }
  Serial.println("Connected to WiFi");

  Blynk.begin(auth, ssid, pass, "blynk.cloud", 80);
  timer.setInterval(15000L, sendSensor);  // Set interval to 15 seconds

  timeClient.begin();

  if (!rtc.begin()) {
    Serial.println("Couldn't find RTC");
    while (1);
  }
}

void loop() {
  Blynk.run();
  timer.run();

  timeClient.update();

  if (digitalRead(pirPin) == HIGH) {
    if (!motionDetected) {
      Serial.println("Motion detected!");
      motionDetected = true;
      delay(100);
    }
  } else {
    Serial.println("Motion stopped!");
    motionDetected = false;
    delay(200);
  }

  if (showTemperature) {
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Suhu : ");
    lcd.print(dht.readTemperature());
    lcd.print(" C");

    lcd.setCursor(0, 1);
    lcd.print("Lembab : ");
    lcd.print(dht.readHumidity());
    lcd.print("%");

    delay(2000);
  } else {
    DateTime now = rtc.now();

    if (timeClient.getMinutes() != 0) {
      now = timeClient.getEpochTime() + TimeZoneInSeconds;
    }

    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Waktu : ");
    printDigits(now.hour());
    lcd.print(':');
    printDigits(now.minute());

    lcd.setCursor(0, 1);
    lcd.print("Tgl : ");
    printDigits(now.day());
    lcd.print('-');
    printDigits(now.month());
    lcd.print('-');
    lcd.print(now.year());

    delay(2000);
  }

  showTemperature = !showTemperature;
}

void printDigits(int digits) {
  if (digits < 10)
    lcd.print('0');
  lcd.print(digits);
}

void sendSensor() {
  float h = dht.readHumidity();
  float t = dht.readTemperature();
  if (isnan(h) || isnan(t)) {
    Serial.println("Failed to read from DHT sensor!");
    return;
  }

  // Kirim data ke Blynk
  Blynk.virtualWrite(V0, t);
  Blynk.virtualWrite(V1, h);

  Serial.print("Suhu : ");
  Serial.print(t);
  Serial.print(" || Kelembaban : ");
  Serial.println(h);

  // Kirim data ke server lokal MySQL
  sendToMySQL(t);
}

void sendToMySQL(float temperature) {
  if (WiFi.status() == WL_CONNECTED) {
    WiFiClient client;
    HTTPClient http;
    String serverAddress = "http://192.168.1.104/esp_database/input.php?data_sensor=" + String(temperature);
    http.begin(client, serverAddress);
    int httpCode = http.GET();
    if (httpCode > 0) {
      String payload = http.getString();
      Serial.println(payload);
    }
    http.end();
  }
}