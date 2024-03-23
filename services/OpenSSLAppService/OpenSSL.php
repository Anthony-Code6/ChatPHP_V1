<?php
class OpenSSL{
    private $metodo = 'AES-256-CBC';
    private $password = 'ABCD-123.AER';

    public function Cifrado($texto){
        $ivSize = openssl_cipher_iv_length($this->metodo);
        $iv = openssl_random_pseudo_bytes($ivSize);

        $cifrado = openssl_encrypt($texto,$this->metodo,$this->password,OPENSSL_RAW_DATA,$iv);
        return base64_encode($iv.$cifrado);
    }

    public function Decifrado($texto){
        $texto = base64_decode($texto);
        $ivSize = openssl_cipher_iv_length($this->metodo);
        $iv = substr($texto,0,$ivSize);
        $decifrado = substr($texto,$ivSize);
        return openssl_decrypt($decifrado,$this->metodo,$this->password,OPENSSL_RAW_DATA,$iv);
    }

}