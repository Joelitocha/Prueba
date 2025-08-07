<?php

namespace App\Controllers; // Define el espacio de nombres del controlador

use App\Models\Esp32Model; // Importa el modelo Esp32Model para interactuar con la base de datos

class esp32controller extends BaseController
{
    // Método para insertar un registro en la base de datos desde el ESP32
public function insertar_registro()
{
    $a = $this->request->getJSON(); // Obtiene el JSON del ESP32
    $uid = $a->uid;

    $modelo = new Esp32Model();
    $tarjeta = $modelo->buscar_id($uid); // Busca tarjeta por UID

    // Si la tarjeta no existe
    if (empty($tarjeta)) {
        return $this->response->setJSON([
            "status" => "error",
            "message" => "Tarjeta no registrada"
        ])->setStatusCode(404);
    }

    // Si la tarjeta existe
    $modelo->insertar_registro($uid); // Guarda en registro_acceso_rf

    // Verifica el estado: 1 = activo, 0 = inactivo
    if ($tarjeta[0]['Estado'] == 1) {
        return $this->response->setJSON([
            "status" => "success",
            "message" => "Acceso autorizado"
        ]);
    } else {
        return $this->response->setJSON([
            "status" => "denied",
            "message" => "Acceso denegado: tarjeta inactiva"
        ]);
    }
        public function vincular_esp()
    {
        $a = $this->request->getJSON();
        
        $device_id = $a->device_id;
        $ssid = $a->ssid;
        $password = $a->password;
        $nombre = $a->nombre;
        $user_id = $a->user_id; // El nuevo dato

        $modelo = new Esp32Model();
        
        // Aquí debes implementar la lógica para:
        // 1. Validar el user_id.
        // 2. Insertar el dispositivo en la tabla 'dispositivo'.
        // 3. Asociar el dispositivo con el usuario/empresa.
        // 4. Guardar la configuración de Wi-Fi en la tabla 'config_wifi'.
        
        // Simplemente como ejemplo, vamos a guardar el dispositivo.
        $modelo->vincular_dispositivo($device_id, $ssid, $password, $nombre, $user_id);
        
        return $this->response->setJSON([
            "status" => "ok",
            "message" => "Dispositivo vinculado correctamente."
        ]);
    }
    
    // Y necesitarías otro método para recibir la configuración remota
    public function configurar_wifi()
    {
        // Esta sería la URL para que la ESP32 reciba la configuración remota.
        // Podrías implementar aquí la lógica para guardar la nueva configuración
        // y luego, tu backend le enviaría un HTTP POST al ESP32 con esos datos.
        // Esto va a requerir que tu backend tenga la IP de la ESP32, un detalle
        // que tendremos que resolver más adelante.
    }
}

}

?>