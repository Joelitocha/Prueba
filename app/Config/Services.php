<?php

namespace Config;

use CodeIgniter\Config\BaseService;

class Services extends BaseService
{
    /**
     * Enviar correo usando el servicio configurado en Email.php
     */
    public static function sendEmail(string $email, string $asunto, string $cuerpo): bool
    {
        $emailService = \Config\Services::email();

        $emailService->setTo($email);
        $emailService->setFrom('no-reply@rackon.tech', 'RackON');
        $emailService->setSubject($asunto);
        $emailService->setMessage($cuerpo);

        if ($emailService->send()) {
            log_message('info', "Correo enviado correctamente a {$email}");
            return true;
        } else {
            log_message('error', "Fallo al enviar correo a {$email}: " . $emailService->printDebugger(['headers', 'subject']));
            return false;
        }
    }
}