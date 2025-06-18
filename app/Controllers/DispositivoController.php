<?php

namespace App\Controllers;

class DispositivoController extends BaseController
{
    public function index()
    {
        $session = session();
        if ($session->get('ID_Rol') != 5) {
            return redirect()->to('/dispositivo')->with('error', 'Acceso denegado');
        }

        return view('dispositivo'); // Vista dispositivo.php en app/Views
    }
}