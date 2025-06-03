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
}

}

?>