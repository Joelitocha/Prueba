<?php

namespace App\Controllers; // Define el espacio de nombres de los controladores en el proyecto

use App\Models\RegistroAccesoModel; // Importa el modelo RegistroAccesoModel para interactuar con los registros de acceso en la base de datos
use App\Models\UserModel;

class RegistrosAccesoController extends BaseController
{
    // Método para ver los registros de acceso
    public function verRegistros()
    {
        $session = session();
        $rol = $session->get("ID_Rol");
        $idEmpresa = $session->get("id_empresa");
    
        if ($rol != 5 && $rol != 6) {
            return redirect()->back()->with('error', 'No tienes permiso para ver los registros de acceso.');
        }
    
        if (!$idEmpresa) {
            return redirect()->back()->with('error', 'No se pudo obtener la empresa desde la sesión.');
        }
    
        $registroModel = new RegistroAccesoModel();
    
        // Parámetros de paginación
        $registrosPorPagina = 10;
        $paginaActual = (int)($this->request->getVar('pagina') ?? 1);
        $offset = ($paginaActual - 1) * $registrosPorPagina;
    
        // Obtener registros y total filtrados por empresa
        $data['registros'] = $registroModel->getPaginatedRecordsByEmpresa($idEmpresa, $registrosPorPagina, $offset);
        $data['totalRegistros'] = $registroModel->getTotalRecordsByEmpresa($idEmpresa);
        $data['registrosPorPagina'] = $registrosPorPagina;
        $data['paginaActual'] = $paginaActual;
        $data['totalPaginas'] = ceil($data['totalRegistros'] / $registrosPorPagina);
    
        return view('ver-accesos-tarjeta', $data);
    }
    
}

?>