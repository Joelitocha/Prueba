#include <WiFi.h>
#include <WiFiManager.h>
#include <HTTPClient.h>

const int resetPin = 0;  // Pin del botón (ejemplo GPIO0)
const int sensorPin = 4;
int contador = 0;
String macAddress = "";  // Variable para almacenar la dirección MAC

// Variables para el control de vibración continua
unsigned long vibrationStartTime = 0;
bool isVibrating = false;
bool alertSent = false;

// Variable para el estado del servidor
String estadoServidor = "desconocido";
unsigned long lastEstadoCheck = 0;
const unsigned long ESTADO_CHECK_INTERVAL = 5000; // 5 segundos

void sendAlertToServer() {
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;

    // Configurar la solicitud HTTP
    http.begin("https://rackon.tech/sensor/alertar");
    http.addHeader("Content-Type", "application/json");

    // Crear el JSON con la dirección MAC y la alerta
    String jsonPayload = "{\"mac\":\"" + macAddress + "\",\"alerta\":true}";

    // Enviar la solicitud POST
    int httpResponseCode = http.POST(jsonPayload);

    if (httpResponseCode > 0) {
      String response = http.getString();
      Serial.print("✅ Alerta enviada al servidor. Código: ");
      Serial.println(httpResponseCode);
      Serial.print("Respuesta: ");
      Serial.println(response);
    } else {
      Serial.print("❌ Error al enviar alerta: ");
      Serial.println(httpResponseCode);
    }

    http.end();
  } else {
    Serial.println("❌ WiFi no conectado, no se puede enviar alerta");
  }
}

void checkEstadoFromServer() {
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;

    // Configurar la solicitud HTTP
    http.begin("https://rackon.tech/sensor/manejar_estado");
    http.addHeader("Content-Type", "application/json");

    // Crear el JSON con la dirección MAC
    String jsonPayload = "{\"mac\":\"" + macAddress + "\"}";

    // Enviar la solicitud POST
    int httpResponseCode = http.POST(jsonPayload);

    if (httpResponseCode == 200) {
      String response = http.getString();
      Serial.print("✅ Estado recibido: ");
      Serial.println(response);

      // PARSING MEJORADO - LIMPIAR LAS COMILLAS
      int estadoIndex = response.indexOf("\"estado\":");
      
      if (estadoIndex == -1) {
        Serial.println("❌ No se encontró el campo 'estado' en la respuesta");
        estadoServidor = "error_campo";
        return;
      }
      
      estadoIndex += 9; // Longitud de "\"estado\":"
      
      char nextChar = response.charAt(estadoIndex);
      
      if (nextChar == '\"') {
        // Estado entre comillas: "estado":"valor"
        estadoIndex++; // Saltar la comilla inicial
        int estadoEndIndex = response.indexOf("\"", estadoIndex);
        estadoServidor = response.substring(estadoIndex, estadoEndIndex);
      } else {
        // Estado sin comillas: "estado":1
        int estadoEndIndex = response.indexOf(",", estadoIndex);
        if (estadoEndIndex == -1) estadoEndIndex = response.indexOf("}", estadoIndex);
        estadoServidor = response.substring(estadoIndex, estadoEndIndex);
        estadoServidor.trim();
      }
      
      // LIMPIAR EL STRING - REMOVER COMILLAS EXTRA
      estadoServidor.replace("\"", ""); // Remover cualquier comilla restante
      estadoServidor.trim(); // Remover espacios
      
      Serial.print("📋 Estado del servidor: '");
      Serial.print(estadoServidor);
      Serial.println("'");
        
    } else {
      Serial.print("❌ Error al obtener estado: ");
      Serial.println(httpResponseCode);
      estadoServidor = "error_http";
    }

    http.end();
  } else {
    Serial.println("❌ WiFi no conectado, no se puede obtener estado");
    estadoServidor = "wifi_error";
  }
}

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

  // Obtener y mostrar la dirección MAC
  macAddress = WiFi.macAddress();
  Serial.print("Dirección MAC: ");
  Serial.println(macAddress);

  // Obtener estado inicial del servidor
  checkEstadoFromServer();

  Serial.println("SENSOR SW420 - LISTO");
}

void loop() {
  static unsigned long lastWiFiCheck = 0;
  if (millis() - lastWiFiCheck > 10000) {
    lastWiFiCheck = millis();
    Serial.print("Estado WiFi: ");
    Serial.println(WiFi.status() == WL_CONNECTED ? "Conectado 👍" : "Desconectado 👎");
  }

  // Verificar estado del servidor cada 5 segundos
  if (millis() - lastEstadoCheck > ESTADO_CHECK_INTERVAL) {
    lastEstadoCheck = millis();
    checkEstadoFromServer();
  }

  // Verificar el sensor de vibración SOLO si el estado del servidor lo permite
  if (digitalRead(sensorPin) == HIGH) {
    if (!isVibrating) {
      // Iniciar vibración
      isVibrating = true;
      vibrationStartTime = millis();
      alertSent = false;
      Serial.println("🚨 Inicio de vibración detectada");
    }

    contador++;
    Serial.print("🚨 Vibración detectada! #");
    Serial.println(contador);

    // Verificar si ha pasado 10 segundos de vibración continua
    if (isVibrating && !alertSent && (millis() - vibrationStartTime >= 10000)) {
      Serial.print("🔍 Verificando estado: '");
      Serial.print(estadoServidor);
      Serial.println("'");
      
      // CONDICIÓN CORREGIDA - ahora compara con "activo" limpio
      if (estadoServidor == "1" || estadoServidor == "true" || 
          estadoServidor == "activo" || estadoServidor == "active" || estadoServidor == "on") {
        Serial.println("⚠️ Vibración continua por 10 segundos - Enviando alerta...");
        sendAlertToServer();
        alertSent = true;
      } else {
        Serial.println("⏸️ Estado del servidor no permite alertas");
        Serial.print("Estado actual: '");
        Serial.print(estadoServidor);
        Serial.println("'");
      }
    }

  } else {
    if (isVibrating) {
      // Vibración terminó
      isVibrating = false;
      alertSent = false;
      unsigned long vibrationDuration = millis() - vibrationStartTime;
      Serial.print("✅ Vibración terminada. Duración: ");
      Serial.print(vibrationDuration / 1000);
      Serial.println(" segundos");
    }
    
    Serial.println("✅ Sin movimiento");
  }

  // Pequeña pausa para evitar sobrecarga
  delay(100);