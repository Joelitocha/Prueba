<?php

namespace App\Controllers;

use App\Models\Esp32Model;

class Esp32Controller extends BaseController
{
    public function insertar_registro()
    {
        $a = $this->request->getJSON();
        $uid = $a->uid;

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
        $a = $this->request->getJSON();

        $device_id = $a->device_id;
        $ssid = $a->ssid;
        $password = $a->password;
        $nombre = $a->nombre;
        $ecode = $a->ecode; // ✅ Lo que manda la ESP ahora

        $modelo = new Esp32Model();
        $empresa = $modelo->obtenerEmpresaPorEcode($ecode);

        if (!$empresa) {
            return $this->response->setJSON([
                "status" => "error",
                "message" => "Ecode no válido o empresa no encontrada"
            ])->setStatusCode(400);
        }

        $empresa_id = $empresa['id_empresa'];

        $modelo->vincular_dispositivo($device_id, $ssid, $password, $nombre, $empresa_id);

        return $this->response->setJSON([
            "status" => "ok",
            "message" => "Dispositivo vinculado correctamente a la empresa."
        ]);
    }

    public function configurar_wifi()
    {
        // Implementar más adelante si querés enviar datos desde el server a la ESP32
    }
}
