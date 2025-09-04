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

    public function guardar()
    {
        $model = new RackModel();

        $nombre    = $this->request->getPost('nombre');
        $ubicacion = $this->request->getPost('ubicacion');
        $estado    = $this->request->getPost('estado');

        if ($model->insertRack($nombre, $ubicacion, $estado)) {
            return redirect()->to('/dispositivo'); // Volver a la lista de racks
        } else {
            echo "Error al guardar el rack.";
        }
    }

    public function eliminar($id)
    {
        $model = new RackModel();
        $model->delete($id);
        return redirect()->to('/dispositivo');
    }
}
