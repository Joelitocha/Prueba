<?php

namespace App\Controllers;
use App\Models\RackModel;

class RackController extends BaseController
{
    public function index()
    {
        $model = new RackModel();
        $data['racks'] = $model->findAll();
        return view('dispositivo', $data); // Muestra la lista de racks
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
            return view('editar-rack', $data); // Muestra el formulario de editar rack
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

        $data = [
            'Ubicacion' => $ubicacion,
            'Estado'    => $estado
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
        if ($model->delete($id)) {
            return redirect()->to('/dispositivo')->with('success', 'Rack eliminado correctamente');
        } else {
            return redirect()->to('/dispositivo')->with('error', 'Error al eliminar el rack');
        }
    }
}
