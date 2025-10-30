<?php

namespace Config;

use CodeIgniter\Config\BaseService;

class Services extends BaseService
{
    public static function sendEmail(string $email, string $asunto, string $cuerpo): bool
    {
        $emailService = \Config\Services::email();

        // LIMPIAR cualquier configuración previa
        $emailService->clear();
        
        $emailService->setTo($email);
        $emailService->setFrom('no-reply@rackon.tech', 'RackON');
        $emailService->setSubject($asunto);
        $emailService->setMessage($cuerpo);

        // FORZAR configuración SMTP explícitamente
        $emailService->SMTPHost = 'email-smtp.sa-east-1.amazonaws.com';
        $emailService->SMTPPort = 587;
        $emailService->SMTPCrypto = 'tls';
        $emailService->SMTPTimeout = 30;

        if ($emailService->send(false)) { // false = no limpiar después del envío
            log_message('info', "✅ Correo enviado a {$email}");
            return true;
        } else {
            $error = $emailService->printDebugger(['headers', 'subject']);
            log_message('error', "❌ Error enviando a {$email}: " . $error);
            return false;
        }
    }
}