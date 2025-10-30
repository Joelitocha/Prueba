<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public string $fromEmail  = 'no-reply@rackon.tech';
    public string $fromName   = 'RackON';
    public string $recipients = '';

    /**
     * Protocolo de envío
     */
    public string $protocol = 'smtp';

    /**
     * Servidor SMTP de Amazon SES
     */
    public string $SMTPHost = 'email-smtp.sa-east-1.amazonaws.com'; // Región: Sudamérica (São Paulo)

    /**
     * Credenciales SMTP de Amazon SES
     */
    public string $SMTPUser = 'AKIAUJQ7RSKIDELQORXV'; // tu "Nombre de usuario de SMTP"
    public string $SMTPPass = 'BNLhm3MWtmovSnuEEjLqQIiTJXW9aCLPfslOQ02f1/U'; // tu "Contraseña SMTP"

    /**
     * Puerto y cifrado
     */
    public int $SMTPPort = 587; // STARTTLS
    public string $SMTPCrypto = 'tls';

    /**
     * Configuración general
     */
    public int $SMTPTimeout = 10;
    public bool $SMTPKeepAlive = false;

    public bool $wordWrap = true;
    public int $wrapChars = 76;

    public string $mailType = 'html';
    public string $charset = 'utf-8';
    public bool $validate = false;
    public int $priority = 3;

    public string $CRLF = "\r\n";
    public string $newline = "\r\n";

    public bool $BCCBatchMode = false;
    public int $BCCBatchSize = 200;

    public bool $DSN = false;
}


