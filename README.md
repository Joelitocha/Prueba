Flujo general
1️⃣ Registro y vinculación de dispositivo
1.	La ESP32 arranca por primera vez y obtiene su Device_ID (puede ser la MAC).
2.	La ESP32 llama a una API:
POST https://rackon.tech/vincular_esp
{
    "device_id": "24:6F:28:AA:BB:CC",
    "nombre": "Rack #1"
}
3.	El backend guarda el dispositivo en la tabla dispositivo.


2️⃣ Configuración de WiFi desde la web
1.	El administrador ingresa al panel → selecciona un dispositivo → edita SSID y password.
2.	La web envía al backend:
POST https://rackon.tech/configurar_wifi
{
    "device_id": "24:6F:28:AA:BB:CC",
    "ssid": "Red_Oficial",
    "password": "12345678"
}
3.	El backend:
o	Guarda SSID y password en la tabla config_wifi.
o	Hace una petición HTTP a la ESP32 enviando el nuevo WiFi.
4.	La ESP32:
o	Recibe el nuevo WiFi.
o	Cambia credenciales, guarda en memoria (Preferences) y reinicia conexión.
o	Responde al backend con "status": "ok" si se conecta.


3️⃣ Lectura de tarjetas RFID
1.	La ESP32 detecta una tarjeta con su lector RC522.
2.	Envía una petición al backend:


POST https://rackon.tech/cargar_acceso
{
    "device_id": "24:6F:28:AA:BB:CC",
    "rfid_uid": "ABCD1234"
}
3.	El backend:
o	Busca en la base de datos si el RFID está asignado a un usuario.
o	Registra el acceso en registro_acceso_rf.
o	Devuelve respuesta a la ESP32 indicando si el acceso está permitido o denegado.
4.	La ESP32 abre o no la cerradura.


4️⃣ Visualización y edición desde la web
•	Panel de administración muestra:
o	Dispositivos registrados.
o	SSID y estado de conexión de cada dispositivo.
o	Logs de accesos RFID.
•	El admin puede modificar el WiFi asociado → backend → ESP32.

