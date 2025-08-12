<?php

namespace App\Models;

use CodeIgniter\Model;

class Esp32Model extends Model
{
    public function insertar_registro($id)
    {
        $table = $this->db->table('registro_acceso_rf');
        $tarjeta = $this->buscar_id($id);

        $data = [
            "Resultado"       => $tarjeta[0]["Estado"],
            "Accion_Tomada"   => NULL,
            "Archivo_Video"   => NULL,
            "Ubicacion_Camara"=> NULL,
            "ID_Sistema"      => NULL,
            "ID_Tarjeta"      => $tarjeta[0]["ID_Tarjeta"]
        ];

        $table->insert($data);
    }

    public function buscar_id($id)
    {
        return $this->db->table('tarjeta_acceso')
                        ->where(["UID" => $id])
                        ->get()
                        ->getResultArray();
    }

    public function obtenerEmpresaPorEcode($ecode)
    {
        return $this->db->table('empresa')
                        ->select('ID_Empresa')
                        ->where('Ecode', $ecode)
                        ->get()
                        ->getRowArray();
    }

    public function vincular_dispositivo($device_id, $ssid, $password, $nombre, $empresa_id)
{
    $table = $this->db->table('sistema_seguridad');

    // 1. Verificar si ya existe un dispositivo con esta MAC (usando 'codevin').
    $existing_device = $table->where('codevin', $device_id)->get()->getRow();

    $data = [
        'nombre'        => $nombre,
        'estado'        => 'activo',
        'Nivel'         => 1,
        'ID_Rack'       => 1, 
        'empresa_id'    => $empresa_id,
        'nombre_ip'     => $ssid,
        'contraseña_ip' => $password
    ];
    
    if ($existing_device) {
        // Si el dispositivo existe, actualiza su información.
        // El ID_Sistema (PK con auto_increment) no se toca.
        return $table->where('ID_Sistema', $existing_device->ID_Sistema)->update($data);
    } else {
        // Si es un dispositivo nuevo, inserta una nueva fila.
        $data['codevin'] = $device_id;
        return $table->insert($data);
    }
}
}

