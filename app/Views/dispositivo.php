
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Configurar Dispositivo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f3;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 400px;
        }

        h2 {
            margin-bottom: 1.5rem;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 1rem;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 0.5rem;
            margin-top: 0.3rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            margin-top: 1.5rem;
            width: 100%;
            padding: 0.7rem;
            background-color: #007bff;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <form action="guardar_configuracion.php" method="POST">
        <h2>Configurar Dispositivo</h2>

        <label for="mac">Dirección MAC</label>
        <input type="text" name="mac" id="mac" required placeholder="Ej: AA:BB:CC:DD:EE:FF">

        <label for="nombre">Nombre del dispositivo</label>
        <input type="text" name="nombre" id="nombre" required placeholder="Ej: Rack Principal">

        <label for="ubicacion">Ubicación</label>
        <input type="text" name="ubicacion" id="ubicacion" required placeholder="Ej: Oficina, Sala de Servidores">

        <label for="ssid">Nombre de red WiFi (SSID)</label>
        <input type="text" name="ssid" id="ssid" required>

        <label for="password">Contraseña WiFi</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Guardar Configuración</button>
    </form>

</body>
</html>