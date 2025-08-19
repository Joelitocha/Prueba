<?php

namespace App\Controllers;

use App\Models\Esp32Model;

use App\Models\RegistroAccesoModel;


class Esp32Controller extends BaseController
{
    public function insertar_registro()
    {
        $data = $this->request->getJSON();
        $uid = $data->uid;
        $mac = $data->device_id;

        $modelo = new Esp32Model();
        $tarjeta = $modelo->buscar_id($uid);
    
        // Si la tarjeta no está registrada
        if (empty($tarjeta)) {
            return $this->response
                ->setJSON([
                    "status" => "error",
                    "message" => "Tarjeta no registrada"
                ])
                ->setStatusCode(404);
        }
    
        // Insertar registro de acceso
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

    public function pruebacamara(){

        $espmodel = new Esp32Model();

        $registromodel = new RegistroAccesoModel();

        $data = $this->request->getJSON();

        $mac = $data->mac ?? null;

        $esp_camera = $modelo->getEspand(['codevin' => $mac, 'Nivel'=>2]);

        if($esp_camera){

            $registros = $registromodel->getRegisterwithoutphoto($esp_camera[0]['ID_Rack']);

            if($registros){

                return $this->response->setJSON(['success' => true]);

            }else{
                return "No hay fotos para sacar";
            }

        }else{

            return "troll";

        }

    }

public function mandarfoto(){
    
        $espmodel = new Esp32Model();

        $registromodel = new RegistroAccesoModel();

    // Obtener el JSON recibido
    $json = $this->request->getJSON();
    
    if (!$json || !isset($json->image)) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Datos JSON inválidos o falta la imagen'
        ])->setStatusCode(400);
    }
    
    // Obtener los datos (solo mac, sin code)
    $mac = isset($json->mac) ? $json->mac : 'Desconocida';
    $base64Image = $json->image;
    
    // Decodificar la imagen base64
    $imageData = base64_decode($base64Image);
    
    if ($imageData === false) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Error al decodificar la imagen base64'
        ])->setStatusCode(400);
    }
    
    $esp=$espmodel->getEspand(['codevin' => $mac, 'Nivel'=>2]);

    $registrosinfoto=$registromodel->getRegisterwithoutphoto($esp[0]['ID_Rack']);

    if ($registrosinfoto) {
        $nombreFoto = 'foto_' . $registrosinfoto[0]['ID_Acceso'] . '_' . date('Ymd_His') . '.jpg';
        $ruta = WRITEPATH . 'uploads/fotos/' . $nombreFoto;
    
    // Guarda la foto en el servidor
        if (file_put_contents($ruta, $imageData)) {
        // Guardar solo la MAC (sin código)
            log_message('info', "Foto recibida de MAC: $mac");

            $registromodel->
        
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Foto recibida y guardada',
                'filename' => $nombreFoto,
                'mac' => $mac,
                'size' => strlen($imageData)
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Error al guardar la foto'
            ])->setStatusCode(500);
        }
    }

    // Genera un nombre único para el archivo

}
}
