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
        $table = $this->db->table('tarjeta_acceso');

        return $this->db->table('tarjeta_acceso')
                        ->where(["UID" => $id])
                        ->get()
                        ->getResultArray();
    }

    public function obtenerEmpresaPorEcode($ecode)
    {
        $table = $this->db->table('empresa');

        return $this->db->table('empresa')
                        ->select('ID_Empresa')
                        ->where('Ecode', $ecode)
                        ->get()
                        ->getRowArray();
    }

    public function vincular_dispositivo($device_id, $ssid, $password, $nombre, $empresa_id)
{
    $table = $this->db->table('sistema_seguridad');

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
        return $table->where('ID_Sistema', $existing_device->ID_Sistema)->update($data);
    } else {
        $data['codevin'] = $device_id;
        return $table->insert($data);
    }
}
}

