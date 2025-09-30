<?php

namespace App\Controllers;
use App\Models\RackModel;

class RackController extends BaseController
{
    public function index()
    {
        $model = new RackModel();

        // Traer el id_empresa de la sesión
        $idEmpresa = session()->get('id_empresa');

        // Buscar racks SOLO de esa empresa
        $data['racks'] = $model->getRacksByEmpresa($idEmpresa);

        return view('dispositivo', $data); // Muestra la lista de racks filtrados
    }
    public function ver($id)
{
    $model = new RackModel();
    $idEmpresa = session()->get('id_empresa');

    // Buscar el rack filtrado por empresa
    $rack = $model->where('ID_Rack', $id)
                  ->where('id_empresa', $idEmpresa)
                  ->first();

    if (!$rack) {
        return redirect()->to('/dispositivo')->with('error', 'No tenés permiso para ver este rack');
    }

    // Cargar dispositivos asociados al rack
    $dispositivoModel = new \App\Models\DispositivoModel();
    $dispositivos = $dispositivoModel->where('ID_Rack', $id)->findAll();

    $data = [
        'rack_seleccionado' => $rack,
        'dispositivos'      => $dispositivos
    ];

    return view('dispositivo', $data);
}


    public function configurar()
    {
        return view('configurar-rack'); // Muestra el formulario de agregar rack
    }

    public function editar($id = null)
    {
        $model = new RackModel();
        
        if ($id) {
            $data['rack'] = $model->find($id);
            if (!$data['rack']) {
                return redirect()->to('/dispositivo')->with('error', 'Rack no encontrado');
            }
            return view('editar-rack', $data); 
        } else {
            return redirect()->to('/dispositivo')->with('error', 'ID de rack no especificado');
        }
    }

    public function guardar()
    {
        $model = new RackModel();

        $id = $this->request->getPost('id_rack');
        $ubicacion = $this->request->getPost('ubicacion');
        $estado    = $this->request->getPost('estado');

        // Traer id_empresa de la sesión
        $idEmpresa = session()->get('id_empresa');

        $data = [
            'Ubicacion'  => $ubicacion,
            'Estado'     => $estado,
            'id_empresa' => $idEmpresa
        ];

        if ($id) {
            // Actualizar rack existente
            if ($model->update($id, $data)) {
                return redirect()->to('/dispositivo')->with('success', 'Rack actualizado correctamente');
            } else {
                return redirect()->back()->withInput()->with('error', 'Error al actualizar el rack');
            }
        } else {
            // Insertar nuevo rack
            if ($model->insert($data)) {
                return redirect()->to('/dispositivo')->with('success', 'Rack creado correctamente');
            } else {
                return redirect()->back()->withInput()->with('error', 'Error al crear el rack');
            }
        }
    }

    public function eliminar($id)
    {
        $model = new RackModel();
        
        // Verificar si el rack tiene dispositivos asociados
        $dispositivoModel = new \App\Models\DispositivoModel();
        $dispositivos = $dispositivoModel->where('ID_Rack', $id)->findAll();
        
        if (!empty($dispositivos)) {
            foreach ($dispositivos as $dispositivo) {
                $dispositivoModel->delete($dispositivo['ID_Sistema']);
            }
        }
        
        if ($model->delete($id)) {
            return redirect()->to('/dispositivo')->with('success', 'Rack eliminado correctamente');
        } else {
            return redirect()->to('/dispositivo')->with('error', 'Error al eliminar el rack');
        }
    }
}