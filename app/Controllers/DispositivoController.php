<?php

namespace App\Controllers;
use App\Models\DispositivoModel;

class DispositivoController extends BaseController
{
    public function vistadisp()
    {
        $model = new DispositivoModel();
        $data['dispositivos'] = $model->findAll();
        return view('dispositivo', $data);
    }

    public function nuevo()
    {
        return view('configurar-dispositivo');
    }

    public function guardar()
    {
        $model = new DispositivoModel();
        if($model->insertar_esp($this->request->getPost('nombre'), $this->request->getPost('mac'), $this->request->getPost('estado'), session()->get('user_id'),1,1)){
            return redirect()->to('/dispositivo');
        }else{
            echo "troll";
        }



        // return redirect()->to('/dispositivo');
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
        $model->update($id, [
            'Nombre' => $this->request->getPost('nombre'),
            'MAC' => $this->request->getPost('mac'),
            'Estado' => $this->request->getPost('estado')
        ]);
        return redirect()->to('/dispositivo');
    }
}