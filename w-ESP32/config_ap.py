import network
import socket
import ujson
import time
import machine

CONFIG_FILE = "wifi_config.json"

def iniciar_access_point():
    ap = network.WLAN(network.AP_IF)
    ap.active(True)
    ap.config(essid="RackON_Config", password="rackon123")
    print("AP activo:", ap.ifconfig())
    return ap

def leer_html():
    with open("config.html", "r") as f:
        return f.read()

def testear_wifi(ssid, password, timeout=20):
    sta = network.WLAN(network.STA_IF)
    sta.active(True)
    sta.connect(ssid, password)
    print(f"Intentando conectar a {ssid}...")

    for i in range(timeout):
        if sta.isconnected():
            ip = sta.ifconfig()[0]
            if ip != "0.0.0.0":
                print("✅ Conectado con IP:", ip)
                return True
        time.sleep(1)
        print(f"Esperando conexión... ({i+1}/{timeout})")

    print("❌ No se pudo conectar a", ssid)
    return False

def guardar_config(ssid, password):
    with open(CONFIG_FILE, "w") as f:
        ujson.dump({"ssid": ssid, "password": password}, f)
    print("✅ Configuración guardada")

def iniciar_web_server():
    html = leer_html()
    addr = socket.getaddrinfo("0.0.0.0", 80)[0][-1]
    s = socket.socket()
    s.bind(addr)
    s.listen(1)
    print("Servidor web activo en 192.168.4.1")

    while True:
        cl, addr = s.accept()
        print("Conexión desde:", addr)
        request = cl.recv(1024).decode()

        if "POST / " in request:
            body = request.split("\r\n\r\n")[-1]
            datos = dict(param.split("=") for param in body.split("&"))
            ssid = datos.get("ssid", "").replace("+", " ")
            password = datos.get("password", "").replace("+", " ")
            print("Datos recibidos → SSID:", ssid, " | PASSWORD:", password)

            if testear_wifi(ssid, password):
                guardar_config(ssid, password)
                respuesta = "<h1>✅ Conexión exitosa. Reiniciando...</h1>"
                cl.send("HTTP/1.1 200 OK\r\nContent-Type: text/html\r\n\r\n")
                cl.send(respuesta)
                cl.close()
                time.sleep(2)
                machine.reset()
            else:
                respuesta = "<h1>❌ Error: No se pudo conectar.<br>Verificá SSID y contraseña.</h1>"
                cl.send("HTTP/1.1 200 OK\r\nContent-Type: text/html\r\n\r\n")
                cl.send(respuesta)
                cl.close()
        else:
            cl.send("HTTP/1.1 200 OK\r\nContent-Type: text/html\r\n\r\n")
            cl.send(html)
            cl.close()

# --------- INICIO AUTOMÁTICO ---------
iniciar_access_point()
iniciar_web_server()
