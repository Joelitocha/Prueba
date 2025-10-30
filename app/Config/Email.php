<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public string $fromEmail  = 'no-reply@rackon.tech';
    public string $fromName   = 'RackON';
    public string $recipients = '';

    public string $userAgent = 'CodeIgniter';
    public string $protocol = 'smtp';
    public string $mailPath = '/usr/sbin/sendmail';
    public string $SMTPHost = 'email-smtp.sa-east-1.amazonaws.com';
    public string $SMTPUser = 'AKIAUJQ7RSKIDELQORXV';
    public string $SMTPPass = 'BNLhm3MWtmovSnuEEjLqQIiTJXW9aCLPfslOQ02f1/U';
    public int $SMTPPort = 587;
    public int $SMTPTimeout = 30;        // aumentamos
    public bool $SMTPKeepAlive = true;   // habilitamos
    public string $SMTPCrypto = 'tls';
    public bool $wordWrap = true;
    public int $wrapChars = 76;
    public string $mailType = 'html';
    public string $charset = 'utf-8';
    public bool $validate = true;
    public int $priority = 3;
    public string $CRLF = "\r\n";
    public string $newline = "\r\n";
    public bool $BCCBatchMode = false;
    public int $BCCBatchSize = 200;
    public bool $DSN = false;
}
