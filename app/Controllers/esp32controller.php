<?php

namespace App\Controllers;

use App\Models\Esp32Model;

class Esp32Controller extends BaseController
{
    public function insertar_registro()
    {
        $data = $this->request->getJSON();
        $uid = $data->uid;

        $modelo = new Esp32Model();
        $tarjeta = $modelo->buscar_id($uid);

        if (empty($tarjeta)) {
            return $this->response->setJSON([
                "status" => "error",
                "message" => "Tarjeta no registrada"
            ])->setStatusCode(404);
        }

        $modelo->insertar_registro($uid);

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

public function vincular_esp()
{
    $data = $this->request->getJSON();

    $device_id = $data->device_id ?? null;
    $ssid = $data->ssid ?? null;
    $password = $data->password ?? null;
    $nombre = $data->nombre ?? null;
    $ecode = $data->ecode ?? null;

    if (!$device_id || !$ssid || !$password || !$nombre || !$ecode) {
        return $this->response->setJSON([
            "status" => "error",
            "message" => "Faltan datos obligatorios"
        ])->setStatusCode(400);
    }

    try {
        $modelo = new Esp32Model();
        $empresa = $modelo->obtenerEmpresaPorEcode($ecode);

        if (!$empresa) {
            return $this->response->setJSON([
                "status" => "error",
                "message" => "Ecode inválido: empresa no encontrada"
            ])->setStatusCode(400);
        }

        $resultado = $modelo->vincular_dispositivo($device_id, $ssid, $password, $nombre, $empresa['id_empresa']);

        if (!$resultado) {
            return $this->response->setJSON([
                "status" => "error",
                "message" => "Error al vincular dispositivo"
            ])->setStatusCode(500);
        }

        return $this->response->setJSON([
            "status" => "ok",
            "message" => "Dispositivo vinculado correctamente a la empresa."
        ]);

    } catch (\Exception $e) {
        return $this->response->setJSON([
            "status" => "error",
            "message" => "Exception: " . $e->getMessage()
        ])->setStatusCode(500);
    }
}


    public function configurar_wifi()
    {
        // Función pendiente si se necesita enviar datos a la ESP32
    }
}
