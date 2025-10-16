<?php 
namespace App\Controllers;

use App\Models\UserModel;
use App\Models\TarjetaModel;
use App\Models\AlertaModel;

class ViewsControllers extends BaseController
{
    public function VistaAsignar() {
        return view("asignar-tarjeta");
    }

    public function VistaGestionar() {
        return view("gestionar-tarjeta");
    }

public function VistaConsultar() {
    $tarjetamodel = new \App\Models\TarjetaModel;
    $id = session()->get('ID_Tarjeta');

    if (empty($id)) {
        return view("consultar-rfid", [
            "error" => "No tienes ninguna tarjeta asociada a tu cuenta."
        ]);
    }

    $tarjeta = $tarjetamodel->obtenerEstado($id);

    if (empty($tarjeta)) {
        return view("consultar-rfid", [
            "error" => "No se encontró información de la tarjeta asociada."
        ]);
    }

    $tarjetaData = [
        'id'               => $tarjeta['ID_Tarjeta'],
        'estado'           => $tarjeta['Estado'] == 1 ? 'Activa' : 'Inactiva',
        'fecha_emision'    => $tarjeta['Fecha_emision'],
        'fecha_expiracion' => $tarjeta['Fecha_Expiracion'] ?? 'No expira',
        'intentos_fallidos'=> $tarjeta['Intentos_Fallidos'],
        'horario_uso'      => $tarjeta['Horario_Uso'] ?? 'Sin restricción'
    ];

    return view("consultar-rfid", ["tarjeta" => $tarjetaData]);
}

public function VistaAlertas()
{
    $session = session();
    $id_empresa = $session->get('id_empresa');

    $alertaModel = new \App\Models\AlertaModel();

    // Obtener alertas paginadas
    $data['alertas'] = $alertaModel->getAlertasByEmpresaPaginadas($id_empresa, 10);
    $data['pager'] = $alertaModel->pager; // necesario para mostrar los botones

    return view('ver-alertas', $data);
}


}