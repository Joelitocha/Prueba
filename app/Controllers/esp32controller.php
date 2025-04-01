<?php

namespace App\Controllers; // Define el espacio de nombres del controlador

use App\Models\Esp32Model; // Importa el modelo Esp32Model para interactuar con la base de datos

class esp32controller extends BaseController
{
    // Método para insertar un registro en la base de datos desde el ESP32
    public function insertar_registro()
    {
        $a = $this->request->getJSON(); // Obtiene el JSON enviado por el ESP32 a través de una solicitud HTTP
        $dato = $a->parametro1; // Extrae el valor de 'parametro1' (presumiblemente el UID de la tarjeta) del JSON recibido
        $modelo = new Esp32Model; // Crea una instancia del modelo Esp32Model para realizar operaciones en la base de datos
        $modelo->insertar_registro($dato); // Llama al método 'insertar_registro' en el modelo, pasando el dato extraído para guardarlo en la base de datos
    }
}

?>