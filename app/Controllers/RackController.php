<?php

namespace App\Controllers;

use App\Models\RackModel;
use App\Models\DispositivoModel;

class RackController extends BaseController
{
    public function index()
    {
        $rackModel = new RackModel();
        $idEmpresa = session()->get('id_empresa');

        $racks = $rackModel->getRacksPorEmpresa($idEmpresa);

        return view('dispositivo', ['racks' => $racks]);
    }

    public function ver($id)
    {
        $rackModel = new RackModel();
        $dispositivoModel = new DispositivoModel();
        $idEmpresa = session()->get('id_empresa');

        // Validar que el rack pertenezca a la empresa del usuario
        $rack = $rackModel->getRackByIdAndEmpresa($id, $idEmpresa);

        if (!$rack) {
            return redirect()->to('/dispositivo')->with('error', 'No tenés permiso para ver este rack');
        }

        $dispositivos = $dispositivoModel->where('ID_Rack', $id)->findAll();

        return view('dispositivo', [
            'rack_seleccionado' => $rack,
            'dispositivos' => $dispositivos
        ]);
    }

    public function guardar()
    {
        $rackModel = new RackModel();
        $id = $this->request->getPost('id_rack');
        $ubicacion = $this->request->getPost('ubicacion');
        $estado = $this->request->getPost('estado');
        $idEmpresa = session()->get('id_empresa');

        $data = [
            'Ubicacion'  => $ubicacion,
            'Estado'     => $estado,
            'id_empresa' => $idEmpresa
        ];

        if ($id) {
            $rackModel->update($id, $data);
            return redirect()->to('/dispositivo')->with('success', 'Rack actualizado correctamente');
        } else {
            $rackModel->insert($data);
            return redirect()->to('/dispositivo')->with('success', 'Rack creado correctamente');
        }
    }

    public function eliminar($id)
    {
        $rackModel = new RackModel();
        $dispositivoModel = new DispositivoModel();
        $idEmpresa = session()->get('id_empresa');

        // Validar que el rack pertenezca a la empresa antes de eliminar
        $rack = $rackModel->getRackByIdAndEmpresa($id, $idEmpresa);

        if (!$rack) {
            return redirect()->to('/dispositivo')->with('error', 'No tenés permiso para eliminar este rack');
        }

        $dispositivos = $dispositivoModel->where('ID_Rack', $id)->findAll();

        if (!empty($dispositivos)) {
            foreach ($dispositivos as $dispositivo) {
                $dispositivoModel->delete($dispositivo['ID_Sistema']);
            }
        }

        $rackModel->delete($id);

        return redirect()->to('/dispositivo')->with('success', 'Rack eliminado correctamente');
    }

    public function configurar()
    {
        return view('configurar-rack');
    }

    public function editar($id)
    {
        $rackModel = new RackModel();
        $idEmpresa = session()->get('id_empresa');

        $rack = $rackModel->getRackByIdAndEmpresa($id, $idEmpresa);

        if (!$rack) {
            return redirect()->to('/dispositivo')->with('error', 'No tenés permiso para editar este rack');
        }

        return view('editar-rack', ['rack' => $rack]);
    }
}
