<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public string $fromEmail  = 'no-reply@rackon.tech';
    public string $fromName   = 'RackON';
    public string $recipients = '';

    public string $protocol = 'smtp';
    public string $SMTPHost = 'email-smtp.sa-east-1.amazonaws.com';
    public string $SMTPUser = 'AKIAIUJQ7RSKIDELQORXV';
    public string $SMTPPass = 'BNLhm3MWtmovSnuEEjLqQIiTJXW9aCLPfslOQ02f1//u';
    public int $SMTPPort = 587;
    public string $SMTPCrypto = 'tls';
    public int $SMTPTimeout = 10;

    public bool $wordWrap = true;
    public int $wrapChars = 76;
    public string $mailType = 'html';
    public string $charset = 'utf-8';
    public bool $validate = true;

    public int $priority = 3;
    public string $CRLF = "\r\n";
    public string $newline = "\r\n";
}

