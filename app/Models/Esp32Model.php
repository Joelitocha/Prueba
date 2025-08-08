<?php

namespace App\Models;

use CodeIgniter\Model;

class Esp32Model extends Model
{
    public function insertar_registro($id)
    {
        $table = $this->db->table('registro_acceso_rf');
        $tarjeta = $this->buscar_id($id);

        $data = array(
            "Resultado" => $tarjeta[0]["Estado"],
            "Accion_Tomada" => NULL,
            "Archivo_Video" => NULL,
            "Ubicacion_Camara" => NULL,
            "ID_Sistema" => NULL,
            "ID_Tarjeta" => $tarjeta[0]["ID_Tarjeta"]
        );

        $table->insert($data);
    }

    public function buscar_id($id)
    {
        $table = $this->db->table('tarjeta_acceso');
        $table->where(["UID" => $id]);
        return $table->get()->getResultArray();
    }

    // 🔎 Buscar ID de empresa por Ecode (clave única de empresa)
    public function obtenerEmpresaPorEcode($ecode)
    {
        $builder = $this->db->table('empresa');
        $builder->select('id_empresa');
        $builder->where('Ecode', $ecode);
        $query = $builder->get();

        return $query->getRowArray(); // Retorna array asociativo con id_empresa
    }

    // 💾 Insertar sistema de seguridad asociado a empresa
    public function vincular_dispositivo($device_id, $ssid, $password, $nombre, $empresa_id)
    {
        $table = $this->db->table('sistema_seguridad');

        $data = [
            'codevin'       => $device_id,
            'nombre'        => $nombre,
            'estado'        => 'activo',
            'Nivel'         => 1, // default
            'ID_Rack'       => 1, // default temporal
            'ID_Empresa'    => $empresa_id,
            'nombre_ip'     => $ssid,
            'contraseña_ip' => $password
        ];

        return $table->insert($data);
    }
}
