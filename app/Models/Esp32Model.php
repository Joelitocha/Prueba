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
        $data = [
            'codevin'       => $device_id,
            'nombre'        => $nombre,
            'estado'        => 'activo',
            'Nivel'         => 1, // valor por defecto
            'ID_Rack'       => 1, // valor por defecto
            'ID_Empresa'    => $empresa_id,
            'nombre_ip'     => $ssid,
            'contraseña_ip' => $password
        ];

        return $this->db->table('sistema_seguridad')->insert($data);
    }
}

