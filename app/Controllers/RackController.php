<?php

namespace App\Controllers;

use App\Models\RackModel;
use App\Models\DispositivoModel;

class RackController extends BaseController
{
    /**
     * Listar todos los racks de la empresa en sesión
     */
    public function index()
    {
        $rackModel = new RackModel();
        $idEmpresa = session()->get('id_empresa');

        $racks = $rackModel->getRacksPorEmpresa($idEmpresa);

        return view('dispositivo', ['racks' => $racks]);
    }

    /**
     * Ver un rack específico y sus dispositivos
     */
    public function ver($id)
    {
        $rackModel = new RackModel();
        $dispositivoModel = new DispositivoModel();
        $idEmpresa = session()->get('id_empresa');

        // 🔹 Validar que el rack sea de la empresa del usuario
        $rack = $rackModel->getRackByIdAndEmpresa($id, $idEmpresa);

        if (!$rack) {
            return redirect()->to('/dispositivo')->with('error', 'No tenés permiso para ver este rack');
        }

        $dispositivos = $dispositivoModel
                        ->where('ID_Rack', $id)
                        ->where('id_empresa', $idEmpresa)
                        ->findAll();

        $data = [
            'rack_seleccionado' => $rack,
            'dispositivos'      => $dispositivos
        ];

        return view('dispositivo', $data);
    }

    /**
     * Mostrar formulario para crear rack
     */
    public function configurar()
    {
        return view('configurar-rack');
    }

    /**
     * Guardar un rack (nuevo o actualizado)
     */
    public function guardar()
    {
        $rackModel = new RackModel();
        $id = $this->request->getPost('id_rack');
        $ubicacion = $this->request->getPost('ubicacion');
        $estado    = $this->request->getPost('estado');
        $idEmpresa = session()->get('id_empresa');

        $data = [
            'Ubicacion'  => $ubicacion,
            'Estado'     => $estado,
            'id_empresa' => $idEmpresa
        ];

        if ($id) {
            // 🔹 Actualizar rack existente
            $rack = $rackModel->getRackByIdAndEmpresa($id, $idEmpresa);

            if (!$rack) {
                return redirect()->to('/dispositivo')->with('error', 'No tenés permiso para editar este rack');
            }

            $rackModel->update($id, $data);
            return redirect()->to('/dispositivo')->with('success', 'Rack actualizado correctamente');
        } else {
            // 🔹 Insertar nuevo rack
            $rackModel->insert($data);
            return redirect()->to('/dispositivo')->with('success', 'Rack creado correctamente');
        }
    }

    /**
     * Mostrar formulario para editar rack
     */
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

    /**
     * Eliminar un rack (y sus dispositivos si los tiene)
     */
    public function eliminar($id)
    {
        $rackModel = new RackModel();
        $dispositivoModel = new DispositivoModel();
        $idEmpresa = session()->get('id_empresa');

        // 🔹 Validar que el rack pertenezca a la empresa
        $rack = $rackModel->getRackByIdAndEmpresa($id, $idEmpresa);

        if (!$rack) {
            return redirect()->to('/dispositivo')->with('error', 'No tenés permiso para eliminar este rack');
        }

        // 🔹 Eliminar dispositivos asociados
        $dispositivos = $dispositivoModel
                        ->where('ID_Rack', $id)
                        ->where('id_empresa', $idEmpresa)
                        ->findAll();

        if (!empty($dispositivos)) {
            foreach ($dispositivos as $dispositivo) {
                $dispositivoModel->delete($dispositivo['ID_Sistema']);
            }
        }

        $rackModel->delete($id);

        return redirect()->to('/dispositivo')->with('success', 'Rack eliminado correctamente');
    }
}


