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
        $tarjetamodel = new TarjetaModel;
        $id = session()->get('ID_tarjeta');
        $data = $tarjetamodel->obtenerEstado($id);
        
        // Procesar los datos para la vista
        $tarjetaData = [
            'id' => $data[0]['ID_Tarjeta'],
            'estado' => $data[0]['Estado'] == 1 ? 'Activa' : 'Inactiva',
            'fecha_emision' => $data[0]['Fecha_emision'],
            'fecha_expiracion' => $data[0]['Fecha_Expiracion'] ?? 'No expira',
            'intentos_fallidos' => $data[0]['Intentos_Fallidos'],
            'horario_uso' => $data[0]['Horario_Uso'] ?? 'Sin restricción'
        ];
        
        return view("consultar-rfid", ["tarjeta" => $tarjetaData]);
    }

    public function VistaAlertas() {

        $alertamodel = new AlertaModel;

        $alertas = $alertamodel->getalertas();

        return view("ver-alertas", ['alertas' => $alertas]);
    }
}