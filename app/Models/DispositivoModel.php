<?php

namespace App\Models;

use CodeIgniter\Model;

class DispositivoModel extends Model
{
    protected $table = 'sistema_seguridad';
    protected $primaryKey = 'ID_Sistema';

    protected $allowedFields = [
        'nombre',
        'mac_address',
        'estado',
        'usuario_id',
        'Nivel',
        'ID_Rack'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'creado_en';
    protected $updatedField  = 'actualizado_en';

    protected $validationRules = [
        'nombre' => 'required|min_length[3]',
        'mac_address' => 'required|regex_match[/^([0-9A-Fa-f]{2}:){5}[0-9A-Fa-f]{2}$/]',
        'estado' => 'required|in_list[activo,inactivo]'
    ];

    protected $validationMessages = [
        'mac_address' => [
            'regex_match' => 'La dirección MAC no es válida, hermano.'
        ]
    ];

    public function insertar_esp($nombre, $mac, $estado, $usuario, $nivel, $idrack, $ip){
        $tabla =$this->db->table('sistema_seguridad');

        if($tabla->insert(['Nombre' => $nombre, 'codevin' => $mac, 'estado' =>$estado, 'usuario_id' =>$usuario,'nivel' => $nivel, 'ID_rack' => $idrack, 'direccion_ip' => $ip])){
            return true;
        }

        return false;
    }

    public function actualizar($id, $nombre, $mac, $estado, $usuario, $nivel, $idrack){
        $tabla =$this->db->table('sistema_seguridad');

        $tabla->where(['ID_Sistema' => $id]);

        $tabla->update(['Nombre' => $nombre, 'mac_address' => $mac, 'estado' =>$estado, 'usuario_id' =>$usuario,'nivel' => $nivel, 'ID_rack' => $idrack]);

    }

    public function eliminar($id){
        $tabla =$this->db->table('sistema_seguridad');

        $tabla->where(['ID_Sistema' => $id]);

        $tabla->delete();
    }
}
