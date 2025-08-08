<?php

namespace App\Models;

use CodeIgniter\Model;

class DispositivoModel extends Model
{
    protected $table = 'sistema_seguridad';
    protected $primaryKey = 'ID_Sistema';

    protected $allowedFields = [
        'nombre',
        'Nivel',
        'codevin',
        'estado',
        'ID_Rack',
        'empresa_id',
        'nombre_ip',
        'contraseña_ip'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'creado_en';
    protected $updatedField  = 'actualizado_en';

    protected $validationRules = [
        'nombre'   => 'required|min_length[3]',
        'codevin'  => 'required|regex_match[/^([0-9A-Fa-f]{2}:){5}[0-9A-Fa-f]{2}$/]',
        'estado'   => 'required|in_list[activo,inactivo]'
    ];

    protected $validationMessages = [
        'codevin' => [
            'regex_match' => 'La dirección MAC no es válida, hermano.'
        ]
    ];

    public function insertar_esp($nombre, $code, $estado, $nivel, $idrack, $empresa_id, $ip = null)
    {
        $tabla = $this->db->table('sistema_seguridad');

        return $tabla->insert([
            'nombre'       => $nombre,
            'codevin'      => $code,
            'estado'       => $estado,
            'Nivel'        => $nivel,
            'ID_Rack'      => $idrack,
            'empresa_id'   => $empresa_id,
            'nombre_ip'    => $ip
        ]);
    }

    public function actualizar($id, $nombre, $code, $estado, $nivel, $idrack, $empresa_id)
    {
        $tabla = $this->db->table('sistema_seguridad');

        return $tabla->where(['ID_Sistema' => $id])->update([
            'nombre'       => $nombre,
            'codevin'      => $code,
            'estado'       => $estado,
            'Nivel'        => $nivel,
            'ID_Rack'      => $idrack,
            'empresa_id'   => $empresa_id
        ]);
    }

    public function eliminar($id)
    {
        $tabla = $this->db->table('sistema_seguridad');
        return $tabla->where(['ID_Sistema' => $id])->delete();
    }
}
