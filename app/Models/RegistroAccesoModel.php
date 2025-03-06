<?php

namespace App\Models;

use CodeIgniter\Model;

class RegistroAccesoModel extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'registro_acceso_rf';
    
    // Clave primaria de la tabla
    protected $primaryKey = 'ID_Acceso';
    
    // Tipo de retorno de los resultados de las consultas
    protected $returnType = 'array';
    
    // Campos que se pueden insertar o actualizar
    protected $allowedFields = [
        'Fecha_Hora',           // Fecha y hora del acceso
        'Resultado',            // Resultado del acceso (permitido, denegado, etc.)
        'Accion_Tomada',       // Acción que se tomó (ejemplo: abrir puerta, enviar alerta)
        'Fecha_Hora_Grabacion', // Fecha y hora en que se grabó el acceso
        'Archivo_Video',       // Ruta del archivo de video relacionado con el acceso
        'Ubicacion_Camara',    // Ubicación de la cámara que registró el acceso
        'ID_Usuario',          // ID del usuario que realizó el acceso
        'ID_Sistema',          // ID del sistema al que se accedió
        'ID_Tarjeta'           // ID de la tarjeta utilizada para el acceso
    ];

    // Función para obtener todos los registros de acceso
    public function getAllRecords()
    {
        return $this->orderBy('Fecha_Hora','DESC')->findAll(); // Devuelve todos los registros de la tabla
    }
}
?>