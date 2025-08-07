1. Arranque Inicial y Configuración Local
Este es el proceso para que el dispositivo se prepare para trabajar por primera vez.
Encendido del ESP32: El dispositivo arranca y verifica si tiene una configuración de Wi-Fi guardada en la memoria (en el archivo wifi_config.json).
Modo AP: Si el archivo no existe, el ESP32 entra en modo Access Point (AP) y crea una red Wi-Fi con un nombre predeterminado, por ejemplo, "RackON_Config".
Configuración del Usuario: Un usuario se conecta a esta red Wi-Fi desde su teléfono o computadora. Abre un navegador y accede a una página web local que ofrece el ESP32.
Vinculación y Conexión: En la página web, el usuario ingresa:
El SSID y la contraseña de la red Wi-Fi de su oficina.
Un código de usuario o empresa que lo identifica en tu sistema.
Envío al Backend: El ESP32 recibe estos datos y, de inmediato, intenta conectarse a la red Wi-Fi de la oficina. Una vez conectado, hace una petición HTTP POST a tu servidor (https://rackon.tech/vincular_esp), enviando su MAC (como device_id), el código de usuario y la configuración de Wi-Fi.
Guardado Local y Reinicio: Si el servidor responde con éxito, el ESP32 guarda las credenciales de Wi-Fi en el archivo wifi_config.json y se reinicia. Esto asegura que la próxima vez se conecte automáticamente.

2. Funcionamiento Normal y Gestión Remota
Una vez que el dispositivo está configurado, sigue este ciclo.
Conexión Automática: La ESP32 se enciende, lee las credenciales del archivo wifi_config.json y se conecta automáticamente a la red.
Servidor de Escucha: Mientras está conectado, el ESP32 mantiene un pequeño servidor HTTP en segundo plano, escuchando en un puerto específico (por ejemplo, el puerto 80).
Lectura de Tarjetas RFID: El dispositivo entra en un bucle principal donde monitorea constantemente el lector RFID (RC522).
Validación de Acceso: Cuando se detecta una tarjeta, la ESP32 envía el UID de la tarjeta y su propio device_id a tu servidor (https://rackon.tech/cargar_acceso).
Decisión del Backend: El servidor recibe esta petición, busca el UID en su base de datos para ver si está asignado a un usuario autorizado y responde a la ESP32 si el acceso es autorizado o denegado.
Acción del ESP32: Basado en la respuesta del servidor, el ESP32 activa el relé y el LED verde (acceso autorizado) o parpadea el LED rojo (acceso denegado).
Modificación de Wi-Fi desde el Panel Web: El administrador puede cambiar el SSID o la contraseña desde el panel web. El servidor, al recibir esta orden, envía una petición HTTP al ESP32 (a la dirección IP que tiene) al endpoint de escucha que creaste en el paso 2, con la nueva configuración. La ESP32 recibe los nuevos datos, los guarda en wifi_config.json y se reinicia para aplicar los cambios.

3. Recuperación ante Fallos
Este paso garantiza que el sistema sea resistente a problemas de conexión.
Fallo de Conexión: Si el ESP32 intenta conectarse con la configuración guardada pero no lo logra (por un cambio de contraseña, router apagado, etc.), activa un mecanismo de respaldo.
Vuelta al Modo AP: Tras varios intentos fallidos, el ESP32 borra el archivo wifi_config.json y vuelve a entrar en modo AP, permitiendo que un usuario lo reconfigure desde cero, tal como se describe en el paso 1.
