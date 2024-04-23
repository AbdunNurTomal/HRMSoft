<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
    'smtp_host' => 'smtp.sendgrid.net', 
    'smtp_port' => 465,
    'smtp_user' => 'apikey',
    'smtp_pass' => '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',
    'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
    'mailtype' => 'html', //plaintext 'text' mails or 'html'
    'smtp_timeout' => '4', //in seconds
    'charset' => 'iso-8859-1',
    'wordwrap' => TRUE
);
