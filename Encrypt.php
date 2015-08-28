<?php


// XOR with key to obfuscate password

class Encrypt {

    function __construct() {

    }

    function encrypt($string, $key) {

        // Our plaintext/ciphertext
        $text =strval($string);

        // Our output text
        $outText = '';

        // Iterate through each character
        for($i=0;$i<strlen($text);)
        {
            for($j=0;($j<strlen($key) && $i<strlen($text));$j++,$i++)
            {
                $outText .= chr(ord($text{$i}) ^ ord($key{$j}));
            }
        }
        return $outText;
    }

    function decrypt($string, $key) {

        return $this->encrypt($string, $key);

    }

// ****************************************************************************
} // end encryption_class
// ****************************************************************************

?>