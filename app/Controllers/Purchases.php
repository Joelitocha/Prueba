<?php

namespace App\Controllers;

use App\Models\PurchaseModel;
use App\Models\EmpresaModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class PurchaseController extends Controller
{
    public function create()
    {
        helper(['form']);

        if ($this->request->getMethod() === 'post') {
            $purchaseModel = new PurchaseModel();
            $empresaModel  = new EmpresaModel();
            $userModel     = new UserModel();

            // datos del formulario
            $empresaNombre = $this->request->getPost('empresa_nombre');
            $email         = $this->request->getPost('email');

            // generar Ecode único de 12 caracteres (A-Z, 0-9)
            $ecode = strtoupper(substr(bin2hex(random_bytes(8)), 0, 12));

            // crear empresa
            $empresaData = [
                'nombre' => $empresaNombre,
                'Ecode'  => $ecode,
            ];
            $empresaModel->insert($empresaData);
            $empresaId = $empresaModel->getInsertID();

            // generar contraseña aleatoria de 12 caracteres
            $plainPassword = substr(bin2hex(random_bytes(8)), 0, 12);

            // crear usuario
            $userData = [
                'Nombre'     => $empresaNombre,
                'Contraseña' => password_hash($plainPassword, PASSWORD_DEFAULT),
                'Email'      => $email,
                'ID_Rol'     => 2, // rol "empresa", ajustalo si es otro
                'id_empresa' => $empresaId,
            ];
            $userModel->insert($userData);

            // guardar la compra
            $purchaseData = [
                'empresa_id' => $empresaId,
                'email'      => $email,
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $purchaseModel->insert($purchaseData);

            // enviar email al usuario
            $this->sendWelcomeEmail($email, $empresaNombre, $plainPassword, $ecode);

            return redirect()->to('/compra-exitosa')->with('success', 'Compra realizada, empresa creada y usuario generado.');
        }

        return view('purchase_form');
    }

    private function sendWelcomeEmail($toEmail, $empresaNombre, $plainPassword, $ecode)
    {
        $email = \Config\Services::email();

        $email->setFrom('RackOnOficial@gmail.com', 'RackOn');
        $email->setTo($toEmail);
        $email->setSubject('Bienvenido a RackON 🚀');

        $message = "
            <h3>Hola {$empresaNombre},</h3>
            <p>Tu usuario ha sido creado exitosamente.</p>
            <p><b>Email:</b> {$toEmail}<br>
            <b>Contraseña:</b> {$plainPassword}<br>
            <b>Ecode:</b> {$ecode}</p>
            <p>¡Gracias por unirte a <b>RackON</b>!</p>
        ";

        $email->setMessage($message);

        if (!$email->send()) {
            log_message('error', 'Error al enviar correo: ' . $email->printDebugger(['headers']));
        }
    }
}
