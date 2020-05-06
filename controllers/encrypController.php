<?php

class encrypController
{
    public function makehash($string)
    {
        $ivlen = 'egxd';
        $iv = substr(hash('sha256', $ivlen), 0, 16);
        syslog(LOG_INFO, 'HOLA');
        $hash = openssl_encrypt($string, 'AES-128-CBC', 'egxd', OPENSSL_RAW_DATA, $iv);
        return base64_encode($hash);
    }

    public static function decrypt($string)
    {
        $stringencode = base64_decode($string);
        $ivlen = 'egxd';
        $iv = substr(hash('sha256', $ivlen), 0, 16);
        return openssl_decrypt($stringencode, 'AES-128-CBC', 'egxd', OPENSSL_RAW_DATA, $iv);
    }
}
