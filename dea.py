# --------- IMPORTACIONES ---------
from machine import Pin, SoftSPI
import time
from mfrc522 import MFRC522
import network
import urequests

# --------- CONFIGURACIÓN WIFI ---------
CONFIG_FILE = "wifi_config.json"
URL_API = "https://rackon.tech/cargar_acceso"

# --------- CONFIGURACIÓN RFID ---------
RST_PIN = 25     # Pin de reset del lector RFID
CS_PIN = 26      # Pin CS del lector RFID
SPI_SCK = 12     # Pin SCK del SPI
SPI_MOSI = 27    # Pin MOSI del SPI
SPI_MISO = 14    # Pin MISO del SPI

# --------- CONFIGURACIÓN SALIDAS ---------
LED_G = Pin(4, Pin.OUT)     # LED verde para acceso autorizado
LED_R = Pin(2, Pin.OUT)     # LED rojo para acceso denegado
RELAY = Pin(33, Pin.OUT)    # Relé para abrir puerta o rack

# --------- CONSTANTES ---------
ACCESS_DELAY = 2500  # Tiempo en milisegundos que se activa el relé

# --------- INICIALIZACIÓN DE DISPOSITIVOS ---------
lector = MFRC522(sck=SPI_SCK, mosi=SPI_MOSI, miso=SPI_MISO, rst=RST_PIN, cs=CS_PIN)

# Aseguramos que los actuadores estén apagados al inicio
LED_G.off()
LED_R.off()
RELAY.off()

# --------- FUNCIONES ---------

def conectar_wifi(reintentos=5):
    """
    Conecta el dispositivo al WiFi configurado.
    Retorna True si la conexión fue exitosa, False si no.
    """
    wifi = network.WLAN(network.STA_IF)
    wifi.active(True)

    if not wifi.isconnected():
        print(f"Conectando a {SSID}...")
        wifi.connect(SSID, PASSWORD)

        for i in range(reintentos):
            if wifi.isconnected():
                break
            time.sleep(5)
            print(f"Intento {i+1}/{reintentos}")

    if wifi.isconnected():
        print("WiFi OK! IP:", wifi.ifconfig()[0])

        # ----------- MOSTRAR MAC -----------
        mac = wifi.config('mac')
        mac_str = ':'.join('{:02X}'.format(b) for b in mac)
        print("MAC Address:", mac_str)
        # -----------------------------------

        return True
    else:
        print("Error WiFi")
        return False

def enviar_uid(uid_bytes):
    """
    Convierte el UID de bytes a string y lo envía al servidor.
    Devuelve el estado de la respuesta: 'success', 'denied' o 'error'.
    """
    uid_str = "0x" + "".join("{:02x}".format(b) for b in uid_bytes)
    print("Enviando UID:", uid_str)
    try:
        response = urequests.post(
            URL_API,
            json={"uid": uid_str},
            headers={"Content-Type": "application/json"}
        )
        print("Código de respuesta:", response.status_code)
        data = response.json()
        print("Mensaje del servidor:", data.get("message"))
        status = data.get("status")
        response.close()
        return status
    except Exception as e:
        print("Error al enviar UID:", e)
        return "error"

def acceso_autorizado():
    """
    Ejecuta las acciones cuando el acceso es autorizado.
    Activa el LED verde y el relé por un tiempo definido.
    """
    print("ACCESO AUTORIZADO")
    LED_G.on()
    RELAY.on()
    time.sleep_ms(ACCESS_DELAY)
    LED_G.off()
    RELAY.off()

def acceso_denegado():
    """
    Ejecuta las acciones cuando el acceso es denegado.
    Parpadea el LED rojo tres veces.
    """
    print("ACCESO DENEGADO")
    for _ in range(3):
        LED_R.on()
        time.sleep_ms(200)
        LED_R.off()
        time.sleep_ms(200)

# --------- PROGRAMA PRINCIPAL ---------
def main():
    """
    Función principal del programa. Escanea continuamente tarjetas RFID
    y envía el UID al servidor para validar acceso.
    """
    if not conectar_wifi():
        print("No se pudo conectar al WiFi.")
    
    print("Sistema listo. Acercá una tarjeta...")

    while True:
        (status, _) = lector.request(lector.REQIDL)
        if status != lector.OK:
            time.sleep(0.1)
            continue

        (status, uid) = lector.anticoll()
        if status != lector.OK:
            continue

        print("\n==============================")
        print("UID detectado:", " ".join("{:02X}".format(b) for b in uid))

        resultado = enviar_uid(uid)

        if resultado == "success":
            acceso_autorizado()
        elif resultado == "denied":
            acceso_denegado()
        else:
            print("Error al validar acceso.")
        
        time.sleep(1)

# --------- EJECUCIÓN ---------
if __name__ == "__main__":
    try:
        main()
    except KeyboardInterrupt:
        print("\nSistema detenido")
        LED_G.off()
        LED_R.off()
        RELAY.off()
