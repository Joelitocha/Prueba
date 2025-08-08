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

        $device_id = $data->device_id;
        $ssid = $data->ssid;
        $password = $data->password;
        $nombre = $data->nombre;
        $ecode = $data->ecode;

        $modelo = new Esp32Model();
        $empresa = $modelo->obtenerEmpresaPorEcode($ecode);

        if (!$empresa) {
            return $this->response->setJSON([
                "status" => "error",
                "message" => "Ecode inválido: empresa no encontrada"
            ])->setStatusCode(400);
        }

        $modelo->vincular_dispositivo($device_id, $ssid, $password, $nombre, $empresa['ID_Empresa']);

        return $this->response->setJSON([
            "status" => "ok",
            "message" => "Dispositivo vinculado correctamente a la empresa."
        ]);
    }

    public function configurar_wifi()
    {
        // Función pendiente si se necesita enviar datos a la ESP32
    }
}
