<?php

namespace Config;

use CodeIgniter\Config\BaseService;

class Services extends BaseService
{
    public static function sendEmail($email, $asunto, $cuerpo)
    {
        $emailService = \Config\Services::email();

        $emailService->setTo($email);
        $emailService->setFrom('no-reply@rackon.tech', 'RackON');
        $emailService->setSubject($asunto);
        $emailService->setMessage($cuerpo);

        if ($emailService->send()) {
            return true;
        } else {
            log_message('error', $emailService->printDebugger(['headers']));
            return false;
        }
    }
}

