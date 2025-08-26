#include "esp_camera.h"
#include <WiFi.h>
#include <HTTPClient.h>
#include <WiFiClientSecure.h>
#include <ArduinoJson.h>

#define CAMERA_MODEL_ESP_EYE
#include "camera_pins.h"

const char* ssid = "ITR3-6";
const char* password = "archivado";
String mac="";

// Endpoints en tu servidor PHP (AWS)
const char* checkEndpoint = "https://rackon.tech/pruebacamara/verificar";
const char* uploadEndpoint = "https://rackon.tech/pruebacamara/mandar";

// Función simple para encode base64
String base64_encode(const uint8_t* data, size_t length) {
  const char* base64_chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
  String encoded_string = "";
  int i = 0;
  int j = 0;
  uint8_t char_array_3[3];
  uint8_t char_array_4[4];

  while (length--) {
    char_array_3[i++] = *(data++);
    if (i == 3) {
      char_array_4[0] = (char_array_3[0] & 0xfc) >> 2;
      char_array_4[1] = ((char_array_3[0] & 0x03) << 4) + ((char_array_3[1] & 0xf0) >> 4);
      char_array_4[2] = ((char_array_3[1] & 0x0f) << 2) + ((char_array_3[2] & 0xc0) >> 6);
      char_array_4[3] = char_array_3[2] & 0x3f;

      for(i = 0; i < 4; i++) {
        encoded_string += base64_chars[char_array_4[i]];
      }
      i = 0;
    }
  }

  if (i) {
    for(j = i; j < 3; j++) {
      char_array_3[j] = '\0';
    }

    char_array_4[0] = (char_array_3[0] & 0xfc) >> 2;
    char_array_4[1] = ((char_array_3[0] & 0x03) << 4) + ((char_array_3[1] & 0xf0) >> 4);
    char_array_4[2] = ((char_array_3[1] & 0x0f) << 2) + ((char_array_3[2] & 0xc0) >> 6);
    char_array_4[3] = char_array_3[2] & 0x3f;

    for (j = 0; j < i + 1; j++) {
      encoded_string += base64_chars[char_array_4[j]];
    }

    while((i++ < 3)) {
      encoded_string += '=';
    }
  }

  return encoded_string;
}

void setup() {
  Serial.begin(115200);
  pinMode(CAM_ENABLE, OUTPUT);
  digitalWrite(CAM_ENABLE, LOW);

  // Obtener la dirección MAC usando WiFi.macAddress()

  
  Serial.print("Dirección MAC: ");
  Serial.println(mac);

  // Configuración completa de la cámara
  camera_config_t config;
  config.ledc_channel = LEDC_CHANNEL_0;
  config.ledc_timer = LEDC_TIMER_0;
  config.pin_d0 = Y2_GPIO_NUM;
  config.pin_d1 = Y3_GPIO_NUM;
  config.pin_d2 = Y4_GPIO_NUM;
  config.pin_d3 = Y5_GPIO_NUM;
  config.pin_d4 = Y6_GPIO_NUM;
  config.pin_d5 = Y7_GPIO_NUM;
  config.pin_d6 = Y8_GPIO_NUM;
  config.pin_d7 = Y9_GPIO_NUM;
  config.pin_xclk = XCLK_GPIO_NUM;
  config.pin_pclk = PCLK_GPIO_NUM;
  config.pin_vsync = VSYNC_GPIO_NUM;
  config.pin_href = HREF_GPIO_NUM;
  config.pin_sccb_sda = SIOD_GPIO_NUM;
  config.pin_sccb_scl = SIOC_GPIO_NUM;
  config.pin_pwdn = PWDN_GPIO_NUM;
  config.pin_reset = RESET_GPIO_NUM;
  config.xclk_freq_hz = 10000000;
  config.frame_size = FRAMESIZE_XGA;
  config.pixel_format = PIXFORMAT_JPEG;
  config.grab_mode = CAMERA_GRAB_WHEN_EMPTY;
  config.fb_location = CAMERA_FB_IN_PSRAM;
  config.jpeg_quality = 20;
  config.fb_count = 1;

  // Inicialización de la cámara
  esp_err_t err = esp_camera_init(&config);
  if (err != ESP_OK) {
    Serial.printf("Camera init failed: 0x%x\n", err);
    return;
  }

  // Conexión WiFi
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\nWiFi connected");
  Serial.print("IP local: ");
  Serial.println(WiFi.localIP());
  String macAddress = WiFi.macAddress();
  mac = macAddress;
}

void loop() {
  if (WiFi.status() == WL_CONNECTED) {
    checkForCaptureRequest();
  } else {
    Serial.println("WiFi disconnected. Reconnecting...");
    WiFi.reconnect();
    delay(2000); // Esperar 2 segundos después de reconectar
  }
  delay(5000); // Espera 5 segundos entre consultas
}

void checkForCaptureRequest() {
  // Verificar WiFi primero
  if (WiFi.status() != WL_CONNECTED) {
    Serial.println("WiFi disconnected in checkForCaptureRequest");
    return;
  }

  WiFiClientSecure client;
  client.setInsecure();
  client.setTimeout(10000); // 10 segundos timeout

  HTTPClient http;
  http.setTimeout(10000);
  
  Serial.print("Consultando servidor: ");
  Serial.println(checkEndpoint);

  if (!http.begin(client, checkEndpoint)) {
    Serial.println("Error en http.begin()");
    return;
  }

  http.addHeader("Content-Type", "application/json");

  // Crear JSON con la dirección MAC
  DynamicJsonDocument doc(256);
  doc["mac"] = mac;

  String jsonString;
  serializeJson(doc, jsonString);

  Serial.print("Enviando MAC: ");
  Serial.println(mac);

  // Enviar la petición POST con el JSON
  int httpCode = http.POST(jsonString);
  
  if (httpCode == HTTP_CODE_OK) {
    String payload = http.getString();
    Serial.print("Respuesta del servidor: ");
    Serial.println(payload);

    DynamicJsonDocument responseDoc(256);
    DeserializationError error = deserializeJson(responseDoc, payload);

    if (error) {
      Serial.print("Error parsing JSON: ");
      Serial.println(error.c_str());
    } else if (responseDoc["capture"] == true) {
      Serial.println("✅ Capturando foto...");
      captureAndUploadPhoto();
    } else {
      Serial.println("❌ No se requiere captura");
      if (responseDoc.containsKey("message")) {
        Serial.print("Mensaje: ");
        Serial.println(responseDoc["message"].as<String>());
      }
    }
  } else {
    Serial.printf("Error HTTP: %d\n", httpCode);
    Serial.print("Error: ");
    Serial.println(http.errorToString(httpCode));
    
    if (httpCode > 0) {
      String response = http.getString();
      Serial.print("Respuesta: ");
      Serial.println(response);
    }
  }
  
  http.end();
  Serial.println("Consulta completada. Esperando 5 segundos...");
}

void captureAndUploadPhoto() {
  camera_fb_t *fb = esp_camera_fb_get();
  if (!fb) {
    Serial.println("Error al capturar foto");
    return;
  }

  Serial.print("Tamaño imagen: ");
  Serial.print(fb->len);
  Serial.println(" bytes");

  WiFiClientSecure client;
  client.setInsecure();
  client.setTimeout(30000);

  HTTPClient http;
  http.setTimeout(30000);
  
  if (!http.begin(client, uploadEndpoint)) {
    Serial.println("Error en http.begin()");
    esp_camera_fb_return(fb);
    return;
  }

  http.addHeader("Content-Type", "application/json");

  // ✅ Codificar la imagen en base64
  String base64Image = base64_encode(fb->buf, fb->len);
  
  Serial.print("Tamaño base64: ");
  Serial.print(base64Image.length());
  Serial.println(" bytes");

  // ✅ Buffer JSON con más margen
  DynamicJsonDocument doc(base64Image.length() + 2048);
  doc["mac"] = mac;
  doc["image"] = base64Image;
  doc["image_size"] = fb->len;

  String jsonString;
  serializeJson(doc, jsonString);

  Serial.print("Tamaño JSON: ");
  Serial.print(jsonString.length());
  Serial.println(" bytes");

  int httpCode = http.POST(jsonString);
  String response = http.getString();

  if (httpCode == HTTP_CODE_OK) {
    Serial.print("✅ Foto enviada. Respuesta: ");
    Serial.println(response);
  } else {
    Serial.print("❌ Error HTTP: ");
    Serial.println(httpCode);
    Serial.print("Respuesta: ");
    Serial.println(response);
  }

  esp_camera_fb_return(fb);
  http.end();
}