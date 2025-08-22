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

        $nombre      = $this->request->getPost('nombre');
        $code        = $this->request->getPost('code');
        $estado      = $this->request->getPost('estado');
        $nivel       = $this->request->getpost('Nivel'); 
        $idrack      = $this->request->getPost('ID_Rack') ?? 1;
        $empresa_id  = session()->get('id_empresa');
        $ip          = $this->request->getpost('nompre_ip'); 
        $contra      = $this->request->getpost('contraseña_ip'); 

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
        $nivel       = $this->request->getpost('Nivel');
        $idrack      = $this->request->getPost('ID_Rack') ?? 1;
        $empresa_id  = session()->get('id_empresa');
        $ip          = $this->request->getpost('nompre_ip'); 
        $contra      = $this->request->getpost('contraseña_ip'); 

        $model->actualizar($id, $nombre, $code, $estado, $nivel, $idrack, $empresa_id, $ip, $contra);

        return redirect()->to('/dispositivo');
    }

    public function eliminar($id)
    {
        $model = new DispositivoModel();
        $model->eliminar($id);
        return redirect()->to('/dispositivo');
    }

    public function rack(){
        return view('/racks');
    }
}
