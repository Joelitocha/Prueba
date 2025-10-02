#include <WiFi.h>
#include <WiFiManager.h>

const int resetPin = 0;   // Pin del botón (ejemplo GPIO0)
const int sensorPin = 4;
int contador = 0;

void setup() {
  Serial.begin(115200);
  delay(1000);

  pinMode(resetPin, INPUT_PULLUP);
  pinMode(sensorPin, INPUT);

  WiFiManager wm;

  if (digitalRead(resetPin) == LOW) {  
    Serial.println("🔄 Borrando configuración WiFi...");
    wm.resetSettings();  // borra credenciales guardadas
  }

  wm.autoConnect("RackON_Sensor_Vibration", "sw420");

  Serial.println("✅ Conectado a WiFi!");
  Serial.print("IP asignada: ");
  Serial.println(WiFi.localIP());

  Serial.println("SENSOR SW420 - LISTO");
}

void loop() {
  static unsigned long lastWiFiCheck = 0;
  if (millis() - lastWiFiCheck > 10000) {
    lastWiFiCheck = millis();
    Serial.print("Estado WiFi: ");
    Serial.println(WiFi.status() == WL_CONNECTED ? "Conectado 👍" : "Desconectado 👎");
  }

  static unsigned long lastSensorCheck = 0;
  if (millis() - lastSensorCheck > 5000) {
    lastSensorCheck = millis();

    if (digitalRead(sensorPin) == HIGH) {
      contador++;
      Serial.print("🚨 Vibración detectada! #");
      Serial.println(contador);
    } else {
      Serial.println("✅ Sin movimiento");
    }
  }
}