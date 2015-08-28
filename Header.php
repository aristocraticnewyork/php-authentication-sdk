<?php

Class Header {

    private $apiKey;

    function __construct($apiKey, $apiSecret) {
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
    }

    protected function createNonce() {
        $chars = "123456789abcdefghijklmnopqrstuvwxyz";
        $random = "" . microtime();
        $random .= mt_rand();
        $mi = strlen($chars) - 1;
        for ($i = 0; $i < 10; $i++) {
            $random .= $chars[mt_rand(0, $mi)];
        }
        $nonce = md5($random);
        return $nonce;
    }

    public function createToken($username, $encryptedPass) {
        $nonce = $this->createNonce();
        $ts = date('c');
        $digest = base64_encode(sha1($nonce.$ts.$this->apiSecret,true));
        return sprintf('AuthToken ApiKey="%s", TokenDigest="%s", Nonce="%s", Created="%s", Username="%s", Password="%s"',
            $this->apiKey, $digest, $nonce, $ts, $username, base64_encode($encryptedPass));
    }
}