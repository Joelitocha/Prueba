<?php
namespace App\Controllers;

class Contact extends BaseController
{
    public function send()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(405)->setJSON(['error' => 'Método no permitido']);
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'nombre' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'asunto' => 'required|min_length[5]',
            'mensaje' => 'required|min_length[10]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setStatusCode(400)->setJSON([
                'error' => 'Datos inválidos',
                'errors' => $validation->getErrors()
            ]);
        }

        $nombre = $this->request->getPost('nombre');
        $email = $this->request->getPost('email');
        $asunto = $this->request->getPost('asunto');
        $mensaje = $this->request->getPost('mensaje');

        // Preparar el contenido del email
        $emailContent = "
        <h2>Nuevo mensaje de contacto desde RackON</h2>
        <p><strong>Nombre:</strong> {$nombre}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Asunto:</strong> {$asunto}</p>
        <p><strong>Mensaje:</strong></p>
        <div>{$mensaje}</div>
        <hr>
        <p><small>Enviado el: " . date('Y-m-d H:i:s') . "</small></p>
        ";

        try {
            // Usar tu servicio de email
            $emailService = \Config\Services::email();
            
            $emailService->setTo('joelitochanderfu@gmail.com'); // Email donde querés recibir los contactos
            $emailService->setFrom('no-reply@rackon.tech', 'RackON Contacto');
            $emailService->setSubject("Contacto RackON: {$asunto}");
            $emailService->setMessage($emailContent);

            if ($emailService->send()) {
                log_message('info', "Contacto enviado correctamente desde: {$email}");
                return $this->response->setJSON([
                    'success' => true,
                    'message' => '¡Mensaje enviado con éxito!'
                ]);
            } else {
                $error = $emailService->printDebugger(['headers']);
                log_message('error', "Fallo enviando contacto: " . $error);
                return $this->response->setStatusCode(500)->setJSON([
                    'error' => 'Error al enviar el mensaje. Intente nuevamente.'
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', "Excepción en contacto: " . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'error' => 'Error del servidor. Intente más tarde.'
            ]);
        }
    }
}