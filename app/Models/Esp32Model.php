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
}
