<?php

namespace Config;

use CodeIgniter\Config\BaseService;

class Services extends BaseService
{
    public static function sendEmail($email, $asunto, $cuerpo)
    {
        $emailService = \Config\Services::email();

        $emailService->setTo($email);
        $emailService->setFrom('rackonoficiall@gmail.com', 'RackON');
        $emailService->setSubject($asunto);
        $emailService->setMessage($cuerpo);

        if ($emailService->send()) {
            return true;
        } else {
            return false;
        }
    }
}
