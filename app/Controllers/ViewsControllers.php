<?php 

namespace App\Controllers; // Definición del espacio de nombres para el controlador

use App\Models\UserModel; // Importación del modelo UserModel (aunque no se utiliza en este controlador)

class ViewsControllers extends BaseController // Definición de la clase ViewsControllers que extiende de BaseController
{
    // Método para cargar la vista de asignación de tarjeta
    public function VistaAsignar() {
        return view("asignar-tarjeta"); // Retorna la vista 'asignar-tarjeta'
    }

    // Método para cargar la vista de gestión de tarjetas
    public function VistaGestionar() {
        return view("gestionar-tarjeta"); // Retorna la vista 'gestionar-tarjeta'
    }

    // Método para cargar la vista de consulta de RFID
    public function VistaConsultar() {
        return view("consultar-rfid"); // Retorna la vista 'consultar-rfid'
    }

    // Método para cargar la vista de alertas
    public function VistaAlertas() {
        return view("ver-alertas"); // Retorna la vista 'ver-alertas'
    }

    // Método para cargar la vista de historial de cambios
    public function VistaHistorial() {
        return view("ver-historial-cambios"); // Retorna la vista 'ver-historial-cambios'
    }
}
?>