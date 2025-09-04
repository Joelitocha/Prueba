<?php

namespace App\Controllers;

use App\Models\DispositivoModel;
use App\Models\RackModel;

class DispositivoController extends BaseController
{
    // Lista de racks o dispositivos de un rack
    public function vistadisp($idRack = null)
    {
        $rackModel = new RackModel();
        $dispositivoModel = new DispositivoModel();

        if ($idRack) {
            // 🔹 Mostrar dispositivos de un rack específico
            $rack = $rackModel->find($idRack);

            if (!$rack) {
                return redirect()->to('/dispositivo')->with('error', 'Rack no encontrado');
            }

            $data['rack_seleccionado'] = [
                'ID_Rack' => $rack['ID_Rack'],
                'nombre'  => "Rack " . $rack['ID_Rack'], // ⚡ podés usar otro campo si tenés
            ];

            $data['dispositivos'] = $dispositivoModel->where('ID_Rack', $idRack)->findAll();

            return view('dispositivo', $data);
        }

        // 🔹 Listado de racks
        $racks = $rackModel->findAll();

        // opcional: contar dispositivos de cada rack
        $racksConDispositivos = array_map(function ($rack) use ($dispositivoModel) {
            $rack['nombre'] = "Rack " . $rack['ID_Rack']; // ⚡ si no tenés un campo "nombre"
            $rack['cantidad_dispositivos'] = $dispositivoModel
                ->where('ID_Rack', $rack['ID_Rack'])
                ->countAllResults();
            $rack['estado'] = $rack['Estado'] == 1 ? 'Activo' : 'Inactivo';
            return $rack;
        }, $racks);

        $data['racks'] = $racksConDispositivos;

        return view('dispositivo', $data);
    }

    public function nuevo()
    {
        return view('configurar-dispositivo');
    }

    public function guardar()
    {
        $model = new DispositivoModel();

        $nombre      = $this->request->getPost('nombre');
        $code        = $this->request->getPost('code');
        $estado      = $this->request->getPost('estado');
        $nivel       = $this->request->getPost('Nivel'); 
        $idrack      = $this->request->getPost('ID_Rack') ?? 1;
        $empresa_id  = session()->get('id_empresa');
        $ip          = $this->request->getPost('nompre_ip'); 
        $contra      = $this->request->getPost('contraseña_ip'); 

        if ($model->insertar_esp($nombre, $code, $estado, $nivel, $idrack, $empresa_id, $ip, $contra)) {
            return redirect()->to('/dispositivo');
        } else {
            echo "Error al guardar el dispositivo.";
        }
    }

    public function configurar($id)
    {
        $model = new DispositivoModel();
        $data['dispositivo'] = $model->find($id);
        return view('editar-dispositivo', $data);
    }

    public function actualizar($id)
    {
        $model = new DispositivoModel();

        $nombre      = $this->request->getPost('nombre');
        $code        = $this->request->getPost('code');
        $estado      = $this->request->getPost('estado');
        $nivel       = $this->request->getPost('Nivel');
        $idrack      = $this->request->getPost('ID_Rack') ?? 1;
        $empresa_id  = session()->get('id_empresa');
        $ip          = $this->request->getPost('nompre_ip'); 
        $contra      = $this->request->getPost('contraseña_ip'); 

        $model->actualizar($id, $nombre, $code, $estado, $nivel, $idrack, $empresa_id, $ip, $contra);

        return redirect()->to('/dispositivo');
    }

    public function eliminar($id)
    {
        $model = new DispositivoModel();
        $model->eliminar($id);
        return redirect()->to('/dispositivo');
    }
}
