import ujson
import os

CONFIG_FILE = "wifi_config.json"

def tiene_config_wifi():
    return CONFIG_FILE in os.listdir()

try:
    if tiene_config_wifi():
        print("Configuración encontrada. Ejecutando programa principal...")
        import ESP32_SOLENOID_LOCK_SEND_DATA_OPTIMIZADO as principal
        principal.main()
    else:
        print("No se encontró configuración WiFi. Iniciando modo Access Point...")
        import config_ap
except KeyboardInterrupt:
    print("🛑 Programa detenido manualmente desde boot.py.")
