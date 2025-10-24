<?php

namespace App\Controllers;

use App\Models\Esp32Model;

use App\Models\RegistroAccesoModel;

use App\Models\AlertaModel;



class Esp32Controller extends BaseController
{
    public function insertar_registro()
    {
        $data = $this->request->getJSON();
        $uid  = $data->uid ?? null;
        $mac  = $data->device_id ?? null;
    
        $modelo  = new Esp32Model();
        $tarjeta = $modelo->buscar_id($uid);
    
        // Si la tarjeta no está registrada
        if (empty($tarjeta)) {
            return $this->response
                ->setJSON([
                    "status"  => "error",
                    "message" => "Tarjeta no registrada"
                ])
                ->setStatusCode(404);
        }
    
        // Insertar registro de acceso (acá podrías guardar también la MAC si lo necesitás)
        $modelo->insertar_registro($uid);
    
        if ((int)$tarjeta[0]['Estado'] === 1) {
            return $this->response->setJSON([
                "status"  => "success",
                "message" => "Acceso autorizado"
            ]);
        } else {
            return $this->response->setJSON([
                "status"  => "denied",
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
    $idrack = $data->id_rack ?? null;


    if (!$device_id || !$ssid || !$password || !$nombre || !$ecode || !$idrack) {
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

    public function pruebacamara() {
    $espmodel = new Esp32Model();
    $registromodel = new RegistroAccesoModel();

    $data = $this->request->getJSON();
    $mac = $data->mac ?? null;

    if (!$mac) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'MAC address required',
            'capture' => false
        ]);
    }

    $esp_camera = $espmodel->getEspand(['codevin' => $mac, 'Nivel' => 2]);

    if ($esp_camera && !empty($esp_camera)) {
        $registros = $registromodel->getRegisterwithoutphoto($esp_camera[0]['ID_Rack']);

        if ($registros && !empty($registros)) {
            return $this->response->setJSON([
                'success' => true,
                'capture' => true,
                'message' => 'Capture required'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => true,
                'capture' => false,
                'message' => 'No photos needed'
            ]);
        }
    } else {
        return $this->response->setJSON([
            'success' => false,
            'capture' => false,
            'message' => 'Device not found'
        ]);
    }
}
public function mandarfoto()
{
    $espmodel = new Esp32Model();
    $registromodel = new RegistroAccesoModel();

    $contentType = $this->request->getHeaderLine('Content-Type');

    $mac = 'Desconocida';
    $imageData = null;

    // ---------- CASO 1: Imagen enviada en JSON con base64 ----------
    if (strpos($contentType, 'application/json') !== false) {
        $json = $this->request->getJSON();

        if (!$json || !isset($json->image)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'JSON inválido o falta el campo image'
            ])->setStatusCode(400);
        }

        $mac = isset($json->mac) ? $json->mac : 'Desconocida';
        $imageData = base64_decode($json->image);

        if ($imageData === false) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Error al decodificar la imagen base64'
            ])->setStatusCode(400);
        }
    }
    // ---------- CASO 2: Imagen enviada como binario (multipart o raw jpeg) ----------
    elseif (strpos($contentType, 'image/jpeg') !== false || strpos($contentType, 'multipart/form-data') !== false) {
        $imageData = file_get_contents("php://input");

        if (!$imageData) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'No se recibió imagen binaria'
            ])->setStatusCode(400);
        }

        // Se puede enviar MAC por cabecera HTTP personalizada
        $mac = $this->request->getHeaderLine('X-Device-MAC') ?: 'Desconocida';
    } else {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Formato no soportado. Use JSON base64 o image/jpeg'
        ])->setStatusCode(415);
    }

    // ---------- Validaciones de seguridad ----------
    if (strlen($imageData) > 1500000) { // 1.5 MB
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'La imagen excede el tamaño máximo permitido'
        ])->setStatusCode(400);
    }

    if (@getimagesizefromstring($imageData) === false) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'El archivo recibido no es una imagen válida'
        ])->setStatusCode(400);
    }

    // ---------- Buscar rack correspondiente ----------
    $esp = $espmodel->getEspand(['codevin' => $mac, 'Nivel' => 2]);
    if (!$esp) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Dispositivo no registrado con MAC: ' . $mac
        ])->setStatusCode(404);
    }

    $registrosinfoto = $registromodel->getRegisterwithoutphoto($esp[0]['ID_Rack']);
    if (!$registrosinfoto) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'No se encontró registro pendiente para este rack'
        ])->setStatusCode(404);
    }

    // ---------- Guardar imagen en writable/uploads/fotos ----------
    $nombreFoto = 'foto_' . $registrosinfoto[0]['ID_Acceso'] . '_' . date('Ymd_His') . '.jpg';
    $directorio = WRITEPATH . 'uploads/fotos/';

    if (!is_dir($directorio)) {
        mkdir($directorio, 0755, true);
    }

    $rutaFisica = $directorio . $nombreFoto;

    if (file_put_contents($rutaFisica, $imageData)) {
        log_message('info', "📸 Foto recibida de MAC: $mac | Tamaño: " . strlen($imageData) . " bytes | Archivo: $nombreFoto");

        // Actualizar registro con la foto
        $registromodel->updateregistro($registrosinfoto[0]['ID_Acceso'], $nombreFoto);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Foto recibida y guardada',
            'filename' => $nombreFoto,
            'mac' => $mac,
            'size' => strlen($imageData),
            'url' => base_url('fotos/mostrar/' . $registrosinfoto[0]['ID_Acceso'])
        ]);
    } else {
        log_message('error', "❌ Error al guardar foto para MAC: $mac");
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Error al guardar la foto en el servidor'
        ])->setStatusCode(500);
    }
}

public function enviaralerta(){

    $json = $this->request->getJSON();
        
    // Validar que se recibió JSON
    if (!$json) {
        return $this->fail('JSON inválido o vacío', 400);
    }

    // Validar campos requeridos
    if (!isset($json->mac) || !isset($json->alerta)) {
        return $this->fail('Campos faltantes: se requieren mac y alerta', 400);
    }

    $mac = $json->mac;

    $alerta = $json->alerta;

    $espmodel = new Esp32Model;

    $placa = $espmodel->getEspand(['codevin' => $mac]);

    if(!$placa) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Placa no vinculada'])->setStatusCode(500);
    }

    $alertamodel=new AlertaModel;

    if($alertamodel->insertAlerta($placa[0]['ID_Rack'])){

        return $this->response->setJSON(['status' => 'success', 'message' => 'Alerta registrada'])->setStatusCode(200);

    }



}

public function manejarestado(){

    $json = $this->request->getJSON();
        
    // Validar que se recibió JSON
    if (!$json || !isset($json->mac)) {
        return $this->fail('JSON inválido o vacío', 400);
    }

    $mac = $json->mac;

    $espmodel = new Esp32Model;

    $placa = $espmodel->getEspand(['codevin' => $mac]);

    if(!$placa){

        return $this->response->setJSON(['status' => 'error', 'message' => 'Placa no vinculada'])->setStatusCode(500);

    }

    return $this->response->setJSON(['status' => 'success', 'estado' => $placa[0]['estado']])->setStatusCode(200);


}


}
