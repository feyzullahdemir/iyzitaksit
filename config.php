<?php

require_once('IyzipayBootstrap.php');

IyzipayBootstrap::init();

class Config
{
    public static function options()
    {
        $options = new \Iyzipay\Options();
<<<<<<< Updated upstream
        $options->setApiKey('ApiKey');
        $options->setSecretKey('SecretKey');
=======
        
>>>>>>> Stashed changes
        $options->setBaseUrl('https://sandbox-api.iyzipay.com');

        return $options;
    }
<<<<<<< Updated upstream
}
=======
}
>>>>>>> Stashed changes
