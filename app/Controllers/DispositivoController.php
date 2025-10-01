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
        $idEmpresa = session()->get('id_empresa'); // 🔹 empresa de la sesión

        if ($idRack) {
            // 🔹 Mostrar dispositivos de un rack específico pero validando empresa
            $rack = $rackModel->where('ID_Rack', $idRack)
                              ->where('id_empresa', $idEmpresa)
                              ->first();

            if (!$rack) {
                return redirect()->to('/dispositivo')->with('error', 'No tenés permiso para ver este rack');
            }

            $data['rack_seleccionado'] = [
                'ID_Rack' => $rack['ID_Rack'],
                'nombre'  => $rack['Ubicacion'], // 🔹 usamos la ubicación como nombre
                'Ubicacion' => $rack['Ubicacion'],
                'Estado'    => $rack['Estado']
            ];

            $data['dispositivos'] = $dispositivoModel
                                    ->where('ID_Rack', $idRack)
                                    ->where('id_empresa', $idEmpresa) // 🔹 solo dispositivos de esa empresa
                                    ->findAll();

            return view('dispositivo', $data);
        }

        // 🔹 Listado de racks SOLO de la empresa
        $racks = $rackModel->where('id_empresa', $idEmpresa)->findAll();

        // Opcional: contar dispositivos de cada rack
        $racksConDispositivos = array_map(function ($rack) use ($dispositivoModel, $idEmpresa) {
            $rack['nombre'] = $rack['Ubicacion'];
            $rack['cantidad_dispositivos'] = $dispositivoModel
                                             ->where('ID_Rack', $rack['ID_Rack'])
                                             ->where('id_empresa', $idEmpresa)
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
