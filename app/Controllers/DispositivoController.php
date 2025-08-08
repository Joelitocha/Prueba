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

        // Estos valores deberían venir del form o sesión, ajustá según tu lógica real
        $nivel       = session()->get('user_id'); // o algo más adecuado si 'nivel' no es el ID del user
        $idrack      = $this->request->getPost('ID_Rack') ?? 1;
        $empresa_id  = session()->get('empresa_id'); // Asegurate de tener este valor cargado en la sesión
        $ip          = null;

        if ($model->insertar_esp($nombre, $code, $estado, $nivel, $idrack, $empresa_id, $ip)) {
            echo "Esperando vinculación";
        } else {
            echo "Error al guardar el dispositivo.";
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

        $nombre      = $this->request->getPost('nombre');
        $code        = $this->request->getPost('code');
        $estado      = $this->request->getPost('estado');
        $nivel       = session()->get('user_id'); // Ajustalo según cómo definas nivel
        $idrack      = $this->request->getPost('ID_Rack') ?? 1;
        $empresa_id  = session()->get('empresa_id');

        $model->actualizar($id, $nombre, $code, $estado, $nivel, $idrack, $empresa_id);

        return redirect()->to('/dispositivo');
    }

    public function eliminar($id)
    {
        $model = new DispositivoModel();
        $model->eliminar($id);
        return redirect()->to('/dispositivo');
    }
}
