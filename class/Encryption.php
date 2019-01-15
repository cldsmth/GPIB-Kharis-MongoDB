<?php
/**
 * simple method to encrypt or decrypt a plain text string
 * initialization vector(IV) has to be the same when encrypting and decrypting
 * 
 * @param string $action: can be 'encrypt' or 'decrypt'
 * @param string $string: string to encrypt or decrypt
 *
 * @return string
 */
class Encryption
{
    const ENCRYPT_METHOD = "AES-256-CBC";
    const SECRET_KEY = "gpibkharis.key";
    const SECRET_IV = "gpibkharis.iv";
    
    public function encrypt_decrypt($action, $string){
        $output = false;
        $key = hash('sha256', self::SECRET_KEY); //hash
        //iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', self::SECRET_IV), 0, 16);
        if($action == "encrypt"){
            $output = openssl_encrypt($string, self::ENCRYPT_METHOD, $key, 0, $iv);
            $output = base64_encode($output);
        }else if($action == "decrypt"){
            $output = openssl_decrypt(base64_decode($string), self::ENCRYPT_METHOD, $key, 0, $iv);
        }
        return $output;
    }
}
?>